@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{ $instructor->user->name }} - Edycja</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::model($instructor->user, [
                  'method' => 'PATCH',
                  'route' => ['admin.instructor.update', $instructor->id]
              ]) !!}

              @include('auth._register')
              
              {!! Form::submit('Edytuj', ['class' => 'btn btn-primary']) !!}
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop