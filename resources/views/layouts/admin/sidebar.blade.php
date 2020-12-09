<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="@lang('admin.user_image')">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">HOME</li>
            <li><a href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_INDEX) }}"> <i class="fa fa-home"></i>@lang('admin.home')</a></li>
            <li class="treeview @if(request()->segment(2) == 'categories') active @endif">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>@lang('admin.categories')</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_CATEGORIES_INDEX) }}"><i class="fa fa-circle-o"></i> @lang('admin.categories_list')</a></li>
                    <li><a href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_CATEGORIES_CREATE) }}"><i class="fa fa-plus"></i> @lang('admin.create_category')</a></li>
                </ul>
            </li>
            <li class="treeview @if(request()->segment(2) == 'customers' || request()->segment(2) == 'addresses') active @endif">
                <a href="#">
                    <i class="fa fa-user"></i> <span>@lang('admin.users')</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_INDEX) }}"><i class="fa fa-circle-o"></i> @lang('admin.users_list')</a></li>
                    <li><a href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_CREATE) }}"><i class="fa fa-plus"></i> @lang('admin.create_user')</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->