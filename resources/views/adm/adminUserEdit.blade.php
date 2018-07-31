@extends('layouts.adm')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$headerForm}}</h3>
        </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-1">
                    <div class="img-center">
                        <img src="{{ asset('upload/'.$dataset['imgPath']) }}">
                    </div>
                </div>
                <div class="col-md-8">
                    <form role="form" action="{{ route($routePost)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="box-body">

                            @foreach($fields as $field)
                            <div class="form-group">

                                @if($field['type'] == 'select')
                                    <label>{{$field['label']}}</label>
                                    <select class="form-control"
                                            {{--value="{{$dataset['permissionGroup[name]' ] }}"--}}
                                            value="{{$dataset[$field['fieldName'] ]}}"
                                            name="{{$field['fieldName']}}"
                                            id="Input_{{$field['fieldName']}}"
                                    >
                                        @foreach($field['selections'] as $selection)
{{--                                            <option>{{$selection['name']}}</option>--}}
                                            <option value="{{$selection['id']}}" {{ $selection['id'] == $dataset[$field['fieldName'] ]?'selected':''}}>{{$selection['name']}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <label for="Input_{{$field['fieldName']}}">
                                        {{$field['label']}}
                                        @if($field['type'] == 'hidden' && isset($dataset[$field['fieldName']] ) )
                                            = {{$dataset[$field['fieldName'] ]}}
                                        @endif

                                    </label>
            {{--                        <label for="Input_{{$field['fieldName']}}">{{$field['label']}} {{isset($field['disabled']) ? $field['disabled']:''}}</label>--}}
                                    <input type="{{$field['type']}}"
                                           class="form-control"
                                           value="{{$dataset[$field['fieldName'] ]}}"
                                           name="{{$field['fieldName']}}"
                                           id="Input_{{$field['fieldName']}}"
                                           placeholder="{{$field['placeholder']}}"
                                    >
                                @endif

                            </div>
                            @endforeach

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

@endsection