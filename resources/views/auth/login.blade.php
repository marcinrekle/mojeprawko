@extends('app')

<!-- @section('head')
    {!! HTML::style('/assets/css/signin.css') !!}
@stop -->

@section('content')


        {!! Form::open(['url' => '#', 'class' => 'form-signin' ] ) !!}


        @include('includes.status')

        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus', 'id' => 'inputEmail' ]) !!}
        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required',  'id' => 'inputPassword' ]) !!}

        <div class="checkbox">
            <label>
                {!! Form::checkbox('remember', 1) !!} Remember me

            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p><a href="#">Forgot password?</a></p>

        <p class="or-social">Or Use Social Login</p>

        <a href="auth/facebook" class="btn btn-lg btn-primary btn-block facebook" role="button">Facebook</a>
        <a href="auth/google" class="btn btn-lg btn-primary btn-block twitter" role="button">Twitter</a>

        {!! Form::close() !!}

@stop