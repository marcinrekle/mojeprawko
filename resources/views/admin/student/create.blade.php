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

              @include('auth._register')
              
              @include('admin.student._form', ['submitBtnText' => 'Dodaj'])
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop