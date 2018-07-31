@extends('layouts.app')

@push('stylesheet')
{{--    <link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}" >--}}
    <link rel="stylesheet" href="{{ asset('css/pars.css') }}" >
@endpush

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col l12">
                    <div class="col l2 panel-header">
                        <p id="nameField" data-userid="{{Auth::user()->id}}"><strong>Парсер. {{Auth::user()->name}}</strong></p>
                    </div>
                    <div class="col l10 panel-search">
                        <input type="text" id="panel-input" value="", placeholder="http:/box.local">
                        <a id="btn-send" class="waves-effect waves-light btn">Парсить</a>
                    </div>
                </div>
            </div>
            <div class="row">

                <div id= 'site-layout-left' class="col s12 m4 l3 site-layout">
                    <div class="site-panels">
                        <div class="collection">
                            @foreach($parSites  as $parSite)
                            <a href="#" class="collection-item" data-id="{{$parSite['id']}}"><span class="badge">{{$parSite['id']}}</span>{{$parSite['site_url']}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="site-layout-right" class="col s12 m8 l9 site-layout" >
                    <div id="show-code" class="card-panel teal site-panels">

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jQueryUI/jQuery.js') }}"></script>
    <script src="{{ asset('materialize/js/materialize.js') }}"></script>
    <script src="{{ asset('js/parse.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@endpush