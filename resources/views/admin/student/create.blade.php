@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Dodawanie kursanta</h3>
          </div>
          <div class="panel-body">
              
            {!! Form::open( [
                  
                  'route' => ['admin.student.store']
              ]) !!}
              
              <div class="form-group">              
                  {!! Form::label('hours_count', 'Godziny:', ['class' => 'control-label']) !!}
                  {!! Form::number('hours_count',old('hours_count'), ['class' => 'form-control','min' => 1, 'max' => 128, 'step' => 0.5, 'placeholder' => 'Podaj ilość godzin']) !!}
              </div>
              <div class="form-group">              
                  {!! Form::label('cost', 'Płatności:', ['class' => 'control-label']) !!}
                  {!! Form::number('cost', old('cost'), ['class' => 'form-control','min' => 10, 'max' => 5000, 'step' => 10, 'placeholder' => 'Podaj cenę kursu']) !!}
              </div>
              
              
              {!! Form::submit('Dodaj', ['class' => 'btn btn-primary']) !!}
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop