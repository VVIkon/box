@extends('layouts.adm')

@section('content')
    <div class="panel-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box">
            <div id="currentuserid" data-userid="{{Auth::user()->id}}"></div>
            <div id="module-root" class="box-body" ></div>

        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

