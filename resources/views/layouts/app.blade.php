<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title') @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="prawko"/>
    @show @section('meta_author')
        <meta name="author" content="Marcin Kazuba"/>
    @show @section('meta_description')
        <meta name="description"
              content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>
    @show

        {!! HTML::style('/css/app.css') !!}

    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{!! asset('img/favicon.ico')  !!} ">
</head>
<body>

@include('partials._header')

@include('partials._nav')

<div class="container">
@include('partials._notifications')
@yield('content')
</div>

@include('partials._footer')

<!-- Scripts -->
{!! HTML::script('/js/all.js') !!}
@yield('scripts')

</body>
</html>