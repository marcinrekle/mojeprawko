@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}} - Lista jazd</h3>
          </div>
          <div class="panel-body">
              
            @include('admin.student.hours._hours', [$student])

            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop