@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}} - godziny</h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-stripped">
              <tr>
                <th>Data</th>
                <th>Ilość</th>
                <th>Instruktor</th>
                <th>Edycja</th>
              </tr>

                @foreach($student->hours as $hour)
                <tr>
                  <td>{{ $hour->drive_date }}</td>
                  <td>{{ $hour->count }}</td>
                  <td>Edek Czarodziej</td>
                  <td>Edytuj</td>
                </tr>
                @endforeach

            </table>

            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop