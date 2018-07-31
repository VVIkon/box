@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p id="nameField" data-userid="{{Auth::user()->id}}"><strong>Владелец галереи {{Auth::user()->name}}</strong></p>
                    </div>
                    <div class="panel-body galery-panel">
                        @foreach($galeryContents as $galeryGroup)
                            <div class="galery-group">
                                <h3>{{$galeryGroup['group_name']}}</h3>

                                @foreach($galeryGroup['galery'] as $picture)
                                    <div class="galery-pic">
                                        <img id="p-{{$picture['id']}}" class = 'img-pic' src="{{ asset('/gal/'.$picture['url_img']) }}" title="{{$picture['comment']}}">
                                        <p class="galery-comment"> {{$picture['comment']}}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div id="modal-view">
                            <img id='modal-img' src="">
                            <p id="modal-comment"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jQueryUI/jQuery.js') }}"></script>
    <script src="{{ asset('js/galery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@endpush