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
                        <th>Aватар</th>
                        <th>Логин</th>
                        <th>eMail(s)</th>
                        <th>Создан</th>
                        <th>Привелегии</th>
                        <th>
                            <a class="btn btn-block btn-success btn-xs" href="{{ route('user.new') }}" title="Добавить пользователя"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr class="tab-row">
                            <td>{{$user->id}}</td>
                            <td style="width: 80px">
                                <img src="{{ asset('upload/'.$user->imgPath) }}">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->permission_group_id}}</td>
                            <td style="width: 65px">
                                <div >
                                    <a class="btn btn btn-xs btn-social-icon btn-facebook" href="{{ route('user.edit',['id' => $user->id,]) }}" title="Изменить реквизиты пользователя"><i class="fa fa-edit" ></i></a>
                                    <form action="{{ route('user.delete')}}" method="POST" style="display:inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="userId" value={{$user->id}} />
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