@extends('layouts.app')

@push('stylesheet')
    {{--<link rel="stylesheet" href="{{ asset('materialize/css/materialize.css') }}" >--}}
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p id="nameField" data-userid="{{Auth::user()->id}}">{{Auth::user()->name}}</p>
                    </div>


                    <div class="panel-body chat-panel">
                        <div class="col-md-3">
                            <aside class="main-sidebar panel-border panel">
                                <div>

                                </div>
                                <div class="panel-border">
                                    <ul class="subscriber-list">
                                        @foreach($subcribeUsers as $subcribeUser)
                                            <li class="subscribers">
                                                <input class="input-subscribers" data-subscriberid="{{$subcribeUser->subscribe_user_id}}" type="checkbox"> {{trim($subcribeUser->user->name)}}
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-9">
                            {{--<div class="panel">--}}
                                {{--@if (session('status'))--}}
                                    {{--<div class="alert alert-success">--}}
                                        {{--{{ session('status') }}--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            <div class="panel-chat-history scroll-area panel-border panel">

                            </div>

                            <div id="msg-edit" class="panel-chat-input">
                                <div id="status"></div>
                                <div class="panel">

                                    <input type="text" id="textField" name="textFld"/>
                                    <button id="btn-send-message"><i class="fa fa-play"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="{{ asset('js/autobahn.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


@endpush
