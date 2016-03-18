<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;

use App\Student;
use App\Instructor;
use App\Drive;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('user_id',Auth::user()->id)->with('hours.drive','payments')->first();
        //$student = Student::where('user_id',10)->with(['hours.drive' ,'payments'])->first();//change - remove
        /* add check status - where active = 1 */
        $status = 'active';
        $studentCanDrive = $student->hours->sum('count')+$student->hours_start < $student->hours_count;
        if ($status != 'active' || !$studentCanDrive) {
            $studentCanDrive = $instructor = false;
            return view('student.index', compact('student', 'instructors', 'studentCanDrive'));
        }
        $payed = $student->payments->sum('amount');
        $drivesPerWeek = collect([200,500,1000]);
        $student->dpwCount = $drivesPerWeek->filter( function ($item, $key) use ($payed) {
            return $item <= $payed;
        })->count();
        $studentCanDriveGtThisWeek = $student->hours->keyBy('drive.date')->sortByDesc('drive.date')->filter( function ($hour, $key) {
                return $key > Carbon::parse('last year 0:00');//change to last week
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
            
        
        return view('student.index', compact('student', 'instructors', 'studentCanDrive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
