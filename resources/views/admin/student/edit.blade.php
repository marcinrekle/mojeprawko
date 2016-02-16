@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{ $student->user->name }} - Edycja</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::model($student, [
                  'method' => 'PATCH',
                  'route' => ['admin.student.update', $student->id]
              ]) !!}
              
              @include('admin.student._form', ['submitBtnText' => 'Edytuj'])
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop