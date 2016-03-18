@extends('layouts.app')

<!-- @section('head')
    {!! Html::style('/assets/css/signin.css') !!}
@stop -->

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Zarejestruj</div>
                <div class="panel-body">

                    {!! Form::open( [
                        'route' => ['auth.register']
                    ]) !!}
              
                        @include('auth._register')

                    {!! Form::submit('Zarejestruj', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection