@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$student->user->name}}</h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-stripped">
              <tr>
                <th>Nazwa</th>
                <th>Godziny</th>
                <th>Płatności</th>
                <th>Edycja</th>
              </tr>

                <tr>
                  <td><a href="{{route('admin.student.show',$student->id)}}" >{{ $student->user->name }}</a></td>
                  <td>{{$student->hours->sum('count') }} / {{ $student->hours_count }}</td>
                  <td>{{$student->payments->sum('amount') }} / {{ $student->cost}}</td>
                  <td>
                    <a href="{{route('admin.student.edit',$student->id)}}">Edytuj</a>
                    <a href="{{route('admin.student.edit',$student->id)}}">Edytuj</a>
                    <a href="/admin/student/{{$student->id}}">Edytuj</a>
                  </td>
                </tr>
                

            </table>

            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop