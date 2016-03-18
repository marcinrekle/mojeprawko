<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

use App\Hour;
use App\Instructor;
use App\Drive;

class DriveController extends Controller
{
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'time'          => 'required|date_format:H:i',
            'hours_count'   => 'required|numeric|min:0.5|max:8',
            'date'          => 'required|date|unique:drives,date,null,id,instructor_id,'.$data['instructor_id']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($instructor_id)
    {
        $instructor = Instructor::findOrFail($instructor_id);
        return view('admin.instructor.drives.index', compact('instructor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($instructor_id)
    {
        $instructor = Instructor::findOrFail($instructor_id);
        $data['date'] = '';
        $data['time'] = '07:00';
        return view('admin.instructor.drives.create', compact('instructor','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $instructor_id)
    {
        $data = $request->all();
        // in drives table is one column and we must check date & time to unique drive - one instructor can have one drive on date 
        $datetime = date_format(date_create("$data[date] $data[time]"), 'Y-m-d h:i');
        $data['date'] = $datetime;
        $data['instructor_id'] = $instructor_id;
        $validator = $this->validator($data);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $drive = new Drive;
        $drive->fill($data);
        $drive->instructor_id = $instructor_id;
        $drive->date = $datetime;
        $drive->save();
        return redirect()->route('admin.instructor.show', $instructor_id)->withSuccess("Dodano jazde w dniu <b> $data[date] </b>");

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
    public function edit($instructor_id,$id)
    {
        $drive = Drive::findOrFail($id);
        $dt = date_create($drive->date);
        $data['date'] = date_format($dt, 'Y-m-d');
        $data['time'] = date_format($dt, 'H:i');
        //dd($data);
        $instructor = Instructor::findOrFail($instructor_id);
        return view('admin.instructor.drives.edit', compact('instructor' , 'drive', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $instructor_id, $id)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $drive = Drive::findOrFail($id);

        $drive = new Drive;
        $drive->fill($data);
        $drive->instructor_id = $instructor_id;
        $drive->date = date_format(date_create("$data[date] $data[time]"), 'y-m-d h:i');
        $drive->save();
        return redirect()->route('admin.instructor.show', $instructor_id)->withSuccess("Dodano jazde w dniu <b>$data[date]</b>");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($instructor_id, $id)
    {
        $drive = Drive::findOrFail($id);
        //$drive->delete();
        return redirect()->route('admin.instructor.show', $instructor_id)->withSuccess("Usunieto jazde z  dnia <b> $drive->date </b>");
    }
}
