<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

use App\Student;
use App\Hour;
use App\Instructor;

class HourController extends Controller
{
    
    protected function validator( array $data )
    {
        return Validator::make( $data, [
            'student_id' => 'required|exists:students,id',
            'count'      => 'numeric|min:0.5|max:3',
            'drive_id'   => 'required|exists:drives,id|unique:hours,drive_id,'.(isset($data['id'])?$data['id']:'null').',id,student_id,'.$data['student_id'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_id)
    {
        $student = Student::findOrFail($student_id);
        //$tmp = [$student_id,$student];
        //dd($tmp);
        return view('admin.student.hours.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($student_id)
    {
        $student = Student::findOrFail($student_id);
        $instructorsList = Instructor::with('user')->get();
        $instructors = $instructorsList->pluck('user')->pluck('name', 'id');
        //$sql = Instructor::find(1)->toSQL();
        $tmp = [$student,$instructorsList,$instructors];
        //dd($tmp);
        return view('admin.student.hours.create', compact('student', 'instructors'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $student_id)
    {
        $tmp = $request->all();
        $tmp['student_id'] = $student_id;
        //dd($tmp);
         $validator = $this->validator($tmp);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Hour::create($tmp);
        return redirect()->back()->withSuccess('Jazdy dodane');
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
    public function edit($student_id,$id)
    {
        $hour = Hour::find($id);
        $student = Student::Find($student_id);
        $instructorsList = Instructor::with('user')->get();
        $instructors = $instructorsList->pluck('user')->pluck('name', 'id');
        $tmp = [$hour,$student,$instructorsList,$instructors];
        //dd($tmp);
        return view('admin.student.hours.edit', compact('student', 'instructors','hour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id, $id)
    {
        $tmp = $request->all();
        $tmp['id'] = $id;
        $tmp['student_id'] = $student_id;
        //dd($tmp);
         $validator = $this->validator( $tmp );

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($tmp);
        $hour = Hour::findOrFail($id);
        $hour->fill($tmp)->save();
        return redirect()->back()->withSuccess('Edycja zakończona pomyślnie');
        // return redirect()->route('admin.student.show', $student_id)->withSuccess('Edycja zakończona pomyślnie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id, $id)
    {
        $hour = Hour::findOrFail($id);
        $hour->delete();
        return redirect()->back()->withSuccess('Usunięto');
    }
}
