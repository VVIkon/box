@extends('layouts.app')

@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}" >
    <link rel="stylesheet" href="{{ asset('materialize/fonts') }}?family=Material+Icons" >
    {{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
@endpush

@section('content')
    <div class="box">
        <div id="currentuserid" data-userid="{{Auth::user()->id}}"></div>
        <div id="module-root" class="box-body"></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('materialize/js/materialize.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endpush