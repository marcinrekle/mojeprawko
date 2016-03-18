@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Lista instruktorów <a href="admin/student/create" class="pull-right"><i class="fa fa-plus"></i></a></h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-striped">
              <tr>
                <th>Nazwa</th>
                <th>Edycja</th>
              </tr>

                @foreach($instructors as $instructor)
                <tr>
                  <td><a href="{{route('admin.instructor.show',$instructor->id)}}" >{{ $instructor->user->name }}</a></td>
                  <td>
                    @include('admin.instructor._options', [$instructor])
                  </td>
                </tr>
                @endforeach

            </table>

            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop