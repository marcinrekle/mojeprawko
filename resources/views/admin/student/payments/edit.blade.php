@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}} - edytowanie wpłaty</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::model( $payment, [
                  'method' => 'PATCH',
                  'route' => ['admin.student.paymentss.update', $student->id,$payment->id]
              ]) !!}
              
              @include('admin.student.payments._form', ['submitBtnText' => 'Edytuj'])
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop