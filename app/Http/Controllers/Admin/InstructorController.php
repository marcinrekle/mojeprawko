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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::with('user')->get();
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
        
        $thisWeekStart = Carbon::parse('this week 0:00');

        $instructor = Instructor::findOrFail($id);
        $drives = $instructor->drives()->orderBy('date','desc')->paginate(30);
        //dump($drives);
        //dd($drives);
        //$drives = Instructor::findOrFail($id)->drives()->with('hours.student.user')->get()->sortByDesc('date');
        $students = Student::where('id','>',5)->with('user')->get()->sortBy('user.name')->pluck('user.name', 'id')->toArray();
        
        $studentsCanDrive = Student::where('id','>',5)->with('hours.drive')->with('payments')->get()->keyBy('id')->sortBy('id');
        
        $studentsCanDrive = $studentsCanDrive->filter(function ( $value, $key ){
            return $value->hours->sum('count')+$value->hours_start < $value->hours_count; 
        });
            //dump($studentsCanDrive->toArray());
        
        
        $drivesThisWeek = Drive::where( \DB::raw("WEEK(date)"), "=", \DB::raw("WEEK(NOW())") )->with('hours')->with('hours')->get()->keyBy('id');
        $list = $drivesThisWeek->map( function($item) {
            $a = $item->hours->keyBy('student_id')->keys()->implode(',');
            //$b = $item->hours->keyBy('student_id')->keys()->toArray();
            //dump( $item->hours->flatten() );
            //dump( $b );
            
            return $a;
        });
        //dump($list);
        $tes = $drivesThisWeek->map( function ($item, $key) {
            $a = $item->hours->map(function ($item, $key){
                //dump($item['student_id']);      
                return ['student_id' => $item['student_id']];
            });
            return $a;
        });
        //dump( $tes ); 
        //dump($drivesThisWeek);



        $studentHC = Student::where('id','>',5)->with('hours')->with('payments')->get();
        $s2 = Student::where('id','>',5)->with('hours.drive')->get()->keyBy('id');
    
        $s2 = $s2->map( function( $item, $key ){
            //dd( $item->toArray() );
        } );
        //dd($s2->toArray());
        $studenty = Student::where('id','>',5)->with('hours.drive')->with('payments')->get()->sortBy('id');
        
        $studenty = $studenty->filter(function ( $value, $key ){
            return $value->hours->sum('count') < $value->hours_count; 
        });
        $studentPaymentsList = $studenty->keyBy('id');
        $studentPaymentsList2 = $studentPaymentsList->map(function($item, $key){
            return $item->hours;
        });
        //dd($studentPaymentsList2->toArray());
        
        $can3 = $studenty->filter(function ( $value, $key ){
            return $value->payments->sum('amount') >= 1000; 
        });
        $can2 = $studenty = $studenty->filter(function ( $value, $key ){
            return $value->payments->sum('amount') < 1000 && $value->payments->sum('amount') > 500 ; 
        });
        $can1 = $studenty = $studenty->filter(function ( $value, $key ){
            return $value->payments->sum('amount') < 500 && $value->payments->sum('amount') > 200 ; 
        });

        /*foreach ($studenty as $student) {
            var_dump( $student->id );
            var_dump( $student->payments->sum('amount') );
        }*/
        //dd($jazdy);

        //$drives = $instructor::with('drives.hours.student.user')->get()->toArray();

        //dd([$instructor, $instructor2, $instructor3,$drives]);
        $students = $this->canDriveInWeek( $studentsCanDrive, $thisWeekStart);

        return view('admin.instructor.show', compact('instructor', 'drives', 'students'));
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
        //$instructor->delete();
        return redirect()->route('admin.instructor.index')->withSuccess('Kursant został usunięty');
    }
}
