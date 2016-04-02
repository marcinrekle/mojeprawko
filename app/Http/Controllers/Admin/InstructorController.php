<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Carbon\Carbon;

use App\Instructor;
use App\Student;
use App\Drive;
use App\User;

class InstructorController extends Controller
{
   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,id',
            'password'      => 'min:6|max:64',
        ]);
    }

    protected function canDriveInWeek( $items, $weekStartDate )
    {
        return $items->filter( function ($item) use ($weekStartDate) {
            //dump( "id = $item->id" );
            $sum = $item->payments->sum('amount');
            //dump( "sum = $sum");
            $hc = $item->hours->count();
            //dump( "hc = $hc");
            $dtw = $item->hours->groupBy('drive.date')->filter( function ( $value, $key) use ($weekStartDate) {
                    return $key > $weekStartDate && $key < Carbon::parse( $weekStartDate)->addWeek();
            })->count();
            return ( $sum > 199 && $sum < 500 && $dtw < 1 ) || ( $sum >= 500  && $sum < 1000 && $dtw < 2 ) || ( $sum > 1000 && $dtw < 3 );
        })->load('user')->pluck('user.name', 'id');
        
    }

    protected function drivesInWeek( $items )
    {
        for ($i=3; $i >= 0; $i--) {
            $item[$i] = $items->keyBy('date')->filter( function( $item, $key) use ( $i) {
                return $key > Carbon::parse('this week 0:00')->addWeeks($i) && $key < Carbon::parse('this week 0:00')->addWeeks($i+1);
            });
            $items = $items->diff($item[$i])->keyBy('date');
        }
        $item['old'] = $items;
        return $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::whereStatus('active')->with('user')->get();
        return view('admin.instructor.index', ['instructors' => $instructors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $data['confirm_code'] = str_random(32);
        $data['avatar'] = '/img/defaultUser.png';
        $user = User::create($data);
        $instructor = new Instructor;
        $instructor->fill($data);
        $user->instructor()->save($instructor);
        $confirm_link = url('auth/confirm',[$user->id,$data['confirm_code']]);
        return redirect()->route('admin.instructor.show', [$user->instructor->id])->withSuccess("Dodano instruktora. <br /> Link do potwierdzenia konta <a href='$confirm_link'>$confirm_link</a>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //var_dump(microtime());
        

        $instructor = Instructor::findOrFail($id);
        $drives = $instructor->drives()->orderBy('date','desc')->paginate(30);
        $studentsAll = Student::with('user')->get()->keyBy('id')->sortBy('id')->pluck('user.name','id');
        if(isset($_GET['page']) && $_GET['page'] > 1 ){
            $canDriveList['old'] = $studentsAll;
            return view('admin.instructor.show', compact('instructor', 'drives','canDriveList'));
        }
        $items = $instructor['drives'] = collect($this->drivesInWeek( $drives ));
        //dd($instructor);
        //$students = Student::whereStatus('active')->with('user')->get()->sortBy('user.name')->pluck('user.name', 'id')->toArray();
        
        //          if page > 1 return view - dont need calculate for reserve drives

        $students = Student::whereStatus('active')->with(['user', 'hours.drive'])->with('payments')->get()->keyBy('id')->sortBy('id');
        $drivesPerWeek = collect([200,500,1000]);
        $students = $students->filter(function ( $value, $key ) {
            return $value->hours->sum('count')+$value->hours_start < $value->hours_count; 
        });

        $studentsDrivesPerWeek = $students->map( function( $item, $key) use ($drivesPerWeek) {
            $payed = $item->payments->sum('amount');
            return $drivesPerWeek->filter( function ($item, $key) use ($payed) {
                return $item <= $payed;
            })->count();
        });
        
        for ($i=0; $i < 4; $i++) { 
            $cantDriveList[$i] = clone $studentsDrivesPerWeek; 
        }
        //dump($cantDriveList);
        for ($i=0; $i < 4; $i++) { 
            $drivesInWeek[$i] = Drive::where('date', '>', Carbon::parse('this week 0:00')->addWeeks($i))->where('date', '<', Carbon::parse('this week 0:00')->addWeeks($i+1))->with('hours')->get()->keyBy('date');
        }
        //dump($drivesInWeek);
        //dd($drivesInWeek);
        collect($drivesInWeek)->each( function ( $item, $key) use ($cantDriveList) {
            $list = $cantDriveList[$key];
            $item->each( function ( $item, $key) use ( $list) {
                $item->hours->keyBy('student_id')->each( function ( $item, $key) use ($list) {
                    if( isset( $list[$key])) {   
                        $list[$key] =- 1;
                    }
                });
            });
            $cantDriveList[$key] = $list;
        });
        //dump($cantDriveList);
        foreach ($cantDriveList as &$cdl) {
            $cdl = $cdl->filter( function ( $item) {
                return $item <= 0;
            });
        }
        //dump($cantDriveList);
        for ($i=0; $i < 4; $i++) { 
            $s = clone $students;
            $canDriveList[$i] = $s->forget($cantDriveList[$i]->keys()->all())->pluck('user.name', 'id');
        }
        $canDriveList['old'] = $studentsAll;
        //dump($canDriveList);
        return view('admin.instructor.show', compact('instructor', 'drives', 'students', 'canDriveList'));

        // END CAN DELETE BOTTOM CODE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('admin.instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        $instructor = Instructor::findOrFail($id);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $user = $instructor->user;
        $user->update($request->all()->expect('password'));
        if($request->get('password') != ""){
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        //$tmp = [$id, $request, $request->all(), $instructor];
        //dd($tmp);

        return redirect()->route('admin.instructor.show', $id)->withSuccess('Dane zostały zmienione');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->user()->delete();
        return redirect()->route('admin.instructor.index')->withSuccess('Instructor został usunięty');
    }
}
