<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

use App\Student;
use App\Payment;

class PaymentController extends Controller
{
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
        return view('admin.student.payments.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($student_id)
    {
        $student = Student::findOrFail($student_id);
        return view('admin.student.payments.create', compact('student'));
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
        //$tmp['payment_date']=date_format(date_create($tmp['payment_date']),'Y-m-d');
        $tmp['student_id'] = $student_id;
        //dd($tmp);
         $validator = Validator::make($tmp, [
            'student_id'    => 'required|exists:students,id',
            'amount'        => 'required|numeric|min:10|max:5000',
            'payment_date'  => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($tmp);
        Payment::create($tmp);
        return redirect()->route('admin.student.show', $student_id)->withSuccess('Płatność dodana');
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
    public function edit($student_id, $id)
    {
        $payment = Payment::find($id);
        $student = Student::Find($student_id);
        $tmp = [$payment,$student];
        //dd($tmp);
        return view('admin.student.payments.edit', compact('student', 'payment'));
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
        $tmp['student_id'] = $student_id;
        //dd($tmp);
         $validator = Validator::make($tmp, [
            'student_id'    => 'required|exists:students,id',
            'amount'        => 'required|numeric|min:10|max:5000',
            'payment_date'  => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($tmp);
        $payment = Payment::findOrFail($id);
        $payment->fill($tmp)->save();
        return redirect()->route('admin.student.show', $student_id)->withSuccess('Edycja zakończona pomyślnie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id, $id)
    {
        $payment = Payment::findOrFail($id);
        //$hour->delete();
        return redirect()->route('admin.student.show', $student_id)->withSuccess('Usunięto');
    }
}
