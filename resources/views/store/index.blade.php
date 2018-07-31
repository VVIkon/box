@extends('layouts.app')

@push('stylesheet')
        <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}" >
        <link rel="stylesheet" href="{{ asset('vuetify/dist/vuetify.css') }}" >
@endpush

@section('content')
    {{--<div class="box">--}}
        {{--<div id="currentuserid" data-userid="{{Auth::user()->id}}"></div>--}}
        <div id="module-root"></div>
    {{--</div>--}}
@endsection

@push('scripts')
{{--    <script src="{{ asset('materialize/js/materialize.js') }}"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vuetify/dist/vuetify.js') }}"></script>
@endpush