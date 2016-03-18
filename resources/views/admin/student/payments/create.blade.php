@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}} - dodawanie wpłaty</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::open( [
                  'route' => ['admin.student.payments.store', $student->id]
              ]) !!}
              
              @include('admin.student.payments._form', ['submitBtnText' => 'Dodaj'])
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop