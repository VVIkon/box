<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    @stack('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script> window.Laravel = {csrfToken:'{{csrf_token() }}'}</script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    @guest
                    {{--for guest--}}
                    @else
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="/">Начало
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Функционал <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Магазин</a></li>
                                <li><a href="{{route('chat.index')}}">Чат</a></li>
                                <li><a href="{{route('blog.index')}}">Блог</a></li>
                                <li><a href="{{route('store.index')}}">Пицерия</a></li>
                                <li><a href="{{route('pic.index')}}">Фото галерея</a></li>
                                <li><a href="#">CRM</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('parser.index')}}">Парсер</a></li>
                                <li><a href="#">Почта</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Карта</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-user-secret"></i> <span>ADM</span>
                                <span class="pull-right-container">
                                        <small class="label pull-right bg-green">new</small>
                                    </span>
                            </a>
                        </li>


                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user-secret"></i>
                                <span class="hidden-xs">Alexander Pierce</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="../../dist/img/user2-160x160.jpg" class="img-image" alt="User Image">
                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>


                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">{{trans('auth_ru.Login')}}</a></li>
                            <li><a href="{{ route('register') }}">{{trans('auth_ru.Register')}}</a></li>
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            LogOut
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        </form>
                                    </li>
                                </ul>

                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    @stack('scripts')
</body>
</html>
