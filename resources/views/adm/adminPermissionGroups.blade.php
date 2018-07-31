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
            <h3 class="box-title">{{$header}}</h3>

            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Группа</th>
                        <th>Описание</th>
                        <th>Привелегии</th>
                        <th>Создан</th>
                        <th>
                            <a class="btn btn-block btn-success btn-xs" href="{{ route('permGoup.new') }}" title="Добавить группу"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissionGroups as $permGroup)
                        <tr class="tab-row">
                            <td>{{$permGroup->id}}</td>
                            <td>{{$permGroup->name}}</td>
                            <td>{{$permGroup->comment}}</td>
                            <td>{{$permGroup->permission_arr}}</td>
                            <td>{{$permGroup->created_at}}</td>
                            <td style="width: 65px">
                                <div >
                                    <a class="btn btn btn-xs btn-social-icon btn-facebook" href="{{ route('permGoup.edit',['id' => $permGroup->id,]) }}" title="Изменить реквизиты группы"><i class="fa fa-edit" ></i></a>
                                    <form action="{{ route('permGoup.delete')}}" method="POST" style="display:inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="$permGroupId" value={{$permGroup->id}} />
                                        <button class="btn btn-xs btn-social-icon btn-google" data-toggle="tooltip" title="Удалить" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="tab-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection