<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="@if(Request::segment(1) == 'home') active @endif">
                <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            @hasrole('Administrator')
            <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-user"></i> <span>{{ __('Data Pengguna') }}</span>
                </a>
            </li>
            @endhasrole


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>