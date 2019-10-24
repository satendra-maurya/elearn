<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview{{{ (Request::is('home') ? ' active' : '') }}}">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview{{{ (Request::is('user') ? ' active' : '') }}}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.user') }}"><i class="fa fa-users"></i> Users List </a></li>
                </ul>
            </li>
            <li class="treeview{{{ (Request::is('notification') || Request::is('notification/create') ? ' active' : '') }}}">
                <a href="{{url('notification')}}">
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </li>
            <li class="treeview{{{ (Request::is('password/change') ? ' active' : '') }}}">
                <a href="{{ route('admin.password.form')}}">
                    <i class="fa fa-gears"></i>
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
    </section>
</aside>