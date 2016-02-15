<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;

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
        $student = Student::findOrFail($id);
        return view('admin.student.show', ['student' => $student]);
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', ['student' => $student]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'hours_count'   => 'required|numeric|min:1|max:128',
            'cost'          => 'required|numeric|min:30|max:5000'
        ]);

        Student::create($request->all());
        return redirect()->back()->withSuccess('Dane zostały zmienione');
    }

    public function update($id, Request $request)
    {
        $student = Student::findOrFail($id);
        
        $this->validate($request,[
            'hours_count'   => 'required|numeric|min:1|max:128',
            'cost'          => 'required|numeric|min:30|max:5000'
        ]);

        $student->fill($request->all())->save();
        //$tmp = [$id, $request, $request->all(), $student];
        //dd($tmp);

        return redirect()->back()->withSuccess('Dane zostały zmienione');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        //$student->delete();
        return redirect()->to('admin\student')->withSuccess('Kursant został usunięty');
    }


}
