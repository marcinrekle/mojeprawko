@extends('layouts.app')

<!-- @section('head')
    {!! Html::style('/assets/css/signin.css') !!}
@stop -->

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Logowanie</h3>
            </div>
            <div class="panel-body">
              
            {!! Form::open(array('url' => URL::to('auth/login'), 'method' => 'post')) !!}
            <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('email', "E-mail", array('class' => 'control-label')) !!}
                {!! Form::text('email', old('email'), array('class' => 'form-control', 'placeholder' => 'Adres E-mail')) !!}
                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
            </div>
            <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', "Hasło", array('class' => 'control-label')) !!}
                {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Hasło')) !!}
                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
            </div>

            {!! Form::submit('Zaloguj', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <br />
            lub
            <br />
            <br />
            <a href="/auth/facebook" class="btn btn-primary" role="button"><i class="fa fa-facebook-official fa-lg"></i> Zaloguj z Facebook</a>
            <a href="/auth/google" class="btn btn-danger" role="button"><i class="fa fa-google fa-lg"></i> Zaloguj z Gmail</a>
            
            </div>
        </div>
        </div>
    </div>
</div>

@stop