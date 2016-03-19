@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}}</h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-striped">
              <tr>
                <th></th>
                <th>Godziny</th>
                <th>Płatności</th>
                <th>Jazdy w tygodniu</th>
                <th>Edycja</th>
              </tr>

                <tr>
                  <td>
                    <div class="placeholder">
                      <img src="{{$instructor->user->avatar}}" class="img-responsive img-circle avatar avatar-big">
                    </div>
                  </td>
                  <td>{{$student->hours->sum('count')+$student->hours_start }} / {{ $student->hours_count }}</td>
                  <td>{{$student->payments->sum('amount') }} / {{ $student->cost}}</td>
                  <td>
                  @if( $studentCanDrive )
                    {{$student->dpwCount}}
                  @endif
                  </td>
                  <td>
                    @include('admin.student._options', [$student])
                  </td>
                </tr>
                

            </table>

            
          </div>
        </div>
      </div>
    </div>
    @if( $studentCanDrive )
      <div class="row" id="reservationPanel">
        <div class="col-md-12">
            @include('student._reserve', [$instructors])
        </div>
      </div>
    @endif
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Jazdy</h3>
          </div>
          <div class="panel-body">
            @include('admin.student.hours._hours', [$student])
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Płatności</h3>
          </div>
          <div class="panel-body">
            @include('admin.student.payments._payments', [$student])
          </div>
        </div>
      </div>
    </div>
  </div>
@stop