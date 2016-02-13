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
              
              <div class="form-group">              
                  {!! Form::label('hours_count', 'Godziny:', ['class' => 'control-label']) !!}
                  {!! Form::number('hours_count', $student->hours_count, ['class' => 'form-control','min' => 1, 'max' => 128, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
              </div>
              <div class="form-group">              
                  {!! Form::label('cost', 'Płatności:', ['class' => 'control-label']) !!}
                  {!! Form::number('cost', $student->cost, ['class' => 'form-control','min' => 10, 'max' => 5000, 'step' => 10, 'placeholder' => 'Podaj cenę kursu']) !!}
              </div>
              
              
              {!! Form::submit('Aktualizuj', ['class' => 'btn btn-primary']) !!}
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop