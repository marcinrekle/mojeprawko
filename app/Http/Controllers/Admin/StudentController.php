<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Carbon\Carbon;

use App\Student;
use App\User;
use App\Instructor;

class StudentController extends Controller
{
    
    /**
	 * Display list of students
	 * 
	 *  @return Response
     */

    public function index()
    {
    	$students = Student::with('hours')->with('payments')->get();
    	//dd($students);
    	return view('admin.student.index', ['students' => $students]);
    }

    public function show($id)
    {
        //$student = Student::findOrFail($id);
        $student = Student::whereId($id)->with('hours.drive','payments')->first();
        $status = 'active';
        $studentCanDrive = $student->hours->sum('count')+$student->hours_start < $student->hours_count;
        if ($student->status != 'active' || !$studentCanDrive) {
            $studentCanDrive = $instructor = false;
            return view('admin.student.show', compact('student', 'instructors', 'studentCanDrive'));
        }
        $payed = $student->payments->sum('amount');
        $drivesPerWeek = collect([200,500,1000]);
        $student->dpwCount = $drivesPerWeek->filter( function ($item, $key) use ($payed) {
            return $item <= $payed;
        })->count();
        $studentCanDriveGtThisWeek = $student->hours->keyBy('drive.date')->sortByDesc('drive.date')->filter( function ($hour, $key) {
                return $key > Carbon::parse('last week 0:00');//change to last week
        });
        for ($i=0; $i < 4; $i++) { 
            $tmp[$i] = $studentCanDriveGtThisWeek->filter( function ($item, $key) use ($i){
                $week = Carbon::parse('this week 0:00')->addWeeks($i);
                return $key > $week && $key < $week->addWeeks(1);
            });
            $studentCanDriveGtThisWeek = $studentCanDriveGtThisWeek->diff($tmp[$i])->keyBy('drive.date');
            $tmp[$i] = $tmp[$i]->count();
        }
        $studentCanDrive = $tmp;

        $instructors = Instructor::with(['drives' => function ($query){ $query->where('date', '>', date('Y-m-d', strtotime('tomorrow'))); }])->get()->keyBy('id');
        foreach ($instructors as $key => $instructor) {
            $sorted = $instructor->drives->keyBy('date');
            for ($i=0; $i < 4; $i++) { 
                $drivesTW[$i] = $sorted->filter( function ($item, $key) use ($i){
                    $week = Carbon::parse('this week 0:00')->addWeeks($i);
                    return $key > $week && $key < $week->addWeeks(1);
                });
                $sorted = $sorted->diff($drivesTW[$i])->keyBy('date');
            }
            $instructor->drives = collect($drivesTW);
        }
        return view('admin.student.show', compact('student', 'instructors', 'studentCanDrive'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,id',
            'password'      => 'min:6|max:64',
            'hours_count'   => 'required|numeric|min:1|max:128',
            'hours_start'   => 'required|numeric|min:0|max:128',
            'cost'          => 'required|numeric|min:30|max:5000',
        ]);
    }

    public function create()
    {
        return view('admin.student.create');
    }


    public function store(Request $request)
    {
        $tmp = $request->all();
        $validator = $this->validator($tmp);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $tmp['confirm_code'] = str_random(32);
        $tmp['avatar'] = '/img/defaultUser.png';
        $user = User::create($tmp);
        $student = new Student;
        $student->fill($tmp);
        $user->student()->save($student);
        $confirm_link = url('auth/confirm',[$user->id,$tmp['confirm_code']]);
        return redirect()->route('admin.student.show', [$user->student->id])->withSuccess("Dodano kursanta. <br /> Link do potwierdzenia konta <a href='$confirm_link'>$confirm_link</a>");
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }


    public function update($id, Request $request)
    {
        $validator = $this->validator($request->all());
        $student = Student::findOrFail($id);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $user = $student->user;
        $user->update($request->except('password'));
        if($request->get('password') != ""){
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        $student->update($request->all());
        $student->save();

        return redirect()->route('admin.student.show', $id)->withSuccess('Dane zostały zmienione');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->user()->delete();
        return redirect()->route('admin.student.index')->withSuccess('Kursant został usunięty');
    }


}
