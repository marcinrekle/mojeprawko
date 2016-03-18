@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$instructor->user->name}} - Lista jazd</h3>
          </div>
          <div class="panel-body">
              
            @include('admin.instructor.drives._drives', [$instructor])

            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop