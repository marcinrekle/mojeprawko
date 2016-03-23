<nav class="navbar navbar-default navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Moje prawko</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(auth::user()->is_admin)
                <li class="{{ (Request::is('/admin') ? 'active' : '') }}">
                    <a href="{{ URL::to('admin') }}"><i class="fa fa-home fa-lg"></i> Admin</a>
                </li>
                <li class="{{ (Request::is('admin/student') ? 'active' : '') }}">
                    <a href="{{ URL::to('admin/student') }}">Kursanci</a>
                </li>
                <li class="{{ (Request::is('admin/instructor') ? 'active' : '') }}">
                    <a href="{{ URL::to('admin/instructor') }}">Instruktorzy</a>
                </li>
                @else
                <li class="{{ (Request::is('/student') ? 'active' : '') }}">
                    <a href="{{ URL::to('student') }}"><i class="fa fa-home fa-lg"></i> </a>
                </li>
                @endif
                <li class="{{ (Request::is('pomoc') ? 'active' : '') }}">
                    <a href="{{ URL::to('pomoc') }}">Pomoc</a>
                </li>
                <li class="{{ (Request::is('kontakt') ? 'active' : '') }}">
                    <a href="{{ URL::to('kontakt') }}">Kontakt</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{{ URL::to('auth/login') }}"><i
                                    class="fa fa-sign-in"></i> Zaloguj</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><img src="{{ Auth::user()->avatar }}" width="30px" height="30px" /> {{ Auth::user()->name }} <i
                                    class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::check())
                                @if(Auth::user()->is_admin==1)
                                    <li>
                                        <a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-tachometer"></i> Panel Administratora</a>
                                    </li>
                                @endif
                                <li role="presentation" class="divider"></li>
                            @endif
                            <li>
                                <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Wyloguj</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>