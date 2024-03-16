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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>{{ __('Data Master') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Pengguna') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>{{ __('Transaksi') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::route()->getName() == 'pasien.index') active @endif">
                        <a href="{{ route('pasien.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Pasien') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'kunjungan.index') active @endif">
                        <a href="{{ route('kunjungan.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Kunjungan') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>