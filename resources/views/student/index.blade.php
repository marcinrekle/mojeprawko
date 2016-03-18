@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{ Auth::user()->name }}</h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-striped">
              <tr>
                <th>Godziny</th>
                <th>Płatności</th>
                <th>Jazdy w tygodniu</th>
                <th>Edycja</th>
              </tr>
                <tr>
                  <td>{{$student->hours->sum('count') + $student->hours_start }} / {{ $student->hours_count }}</td>
                  <td>{{$student->payments->sum('amount') }} / {{ $student->cost }}</td>
                  @if( $studentCanDrive )
                  <td>
                    {{$student->dpwCount}}
                  </td>
                  <td>
                    <a href="">Zarezerwuj jazdę</a>
                  </td>
                  @else
                  <td colspan="2">
                    <span>Twój kurs się zakończył lub wykorzystałeś już wszystkie możliwe jazdy</span>
                  </td>
                  @endif
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