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

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>{{ __('Data Master') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'jenis-barang.index') active @endif">
                        <a href="{{ route('jenis-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Jenis Barang') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'satuan-barang.index') active @endif">
                        <a href="{{ route('satuan-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Satuan Barang') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Data Supplier') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>{{ __('Data Transaksi') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Masuk') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Keluar') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>{{ __('Laporan') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Stok Barang') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Masuk') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Keluar') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Suplier') }}
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>