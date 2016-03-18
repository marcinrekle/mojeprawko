@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$instructor->user->name}} - edytowanie jazdy</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::model( $drive, [
                  'method' => 'PATCH',
                  'route' => ['admin.instructor.drives.update', $instructor->id,$drive->id]
              ]) !!}
              
              @include('admin.instructor.drives._form', ['submitBtnText' => 'Edytuj'])
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop