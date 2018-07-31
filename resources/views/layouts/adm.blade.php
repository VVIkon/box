<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">


    <link href="{{ asset('css/adm.css') }}" rel="stylesheet">
</head>
<body>
    {{--<div id="app">--}}

        @include('adm.navMenu')
        @include('adm.asideMenu')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Установки системы</div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('adm.adminSettings')

    {{--</div>--}}
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
    <script src="{{ asset('js/adm.js') }}"></script>

    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    {{--<script>--}}
        {{--$.widget.bridge('uibutton', $.ui.button);--}}
    {{--</script>--}}
    {{--<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>--}}
{{--    <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>--}}
{{--    <script src="{{ asset('dist/js/adminlte.js') }}"></script>--}}
{{--    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>--}}
    {{--<script src="{{ asset('dist/js/demo.js') }}"></script>--}}
    @stack('scripts')
</body>
</html>
