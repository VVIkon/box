@extends('layouts.adm')

@section('content')
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="box">
            <div class="box-header col-md-10">
                <h3 class="box-title">Привелегии</h3>
            </div>
            <div class="box-plus col-md-2">
                <a class="btn btn-block btn-success btn-xs" href="{{ route('perm.new') }}"><i class="fa fa-plus"></i></a>
            </div>

            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Привелегия</th>
                        <th>Описание</th>
                        <th>Активность</th>
                        <th>Создана</th>
                        <th>***</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissions as $permission)
                        <tr class="tab-row">
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->comment}}</td>
                            <td>{{$permission->active}}</td>
                            <td>{{$permission->created_at}}</td>
                            <td style="width: 65px">
                                <div>
                                    <a class="btn btn btn-xs btn-social-icon btn-facebook" href="{{ route('perm.edit',['id' => $permission->id,]) }}"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('perm.delete')}}" method="POST" style="display:inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="userId" value={{$permission->id}} />
                                        <button class="btn btn-xs btn-social-icon btn-google" data-toggle="tooltip" title="Удалить">
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