<aside class="main-sidebar aside-default panel">
    <section class="sidebar" style="height: auto">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user9-160x120.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Навигация</li>
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Показатели системы</span>
                    {{--<span class="pull-right-container">--}}
                        {{--<small class="label pull-right bg-green">new</small>--}}
                    {{--</span>--}}
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Справочники</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{route('admin.users')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Пользователи</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">{{isset($users)?count($users):'' }}</span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.permissionGroups')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Группы привелегии</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">{{isset($permissionGroups)?count($permissionGroups):'' }}</span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.permissions')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Привелегии</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">{{isset($permissions)?count($permissions):'' }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-chat-o"></i>
                    <span>Блог и Чат</span>
                    <span class="pull-right-container">
                    <span class="label label-primary pull-right">444</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.blogs') }}"><i class="fa fa-circle-o"></i>Блог</a></li>
                    {{--<li><router-link :to="{ name: 'blogChat'}"><i class="fa fa-circle-o"></i>Блог</router-link></li>--}}
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Размещение</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>