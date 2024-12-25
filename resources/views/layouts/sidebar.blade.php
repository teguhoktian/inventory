<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <x-user-panel-sidebar userAvatar="{{ url('/img/no_foto.png') }}" userName="{{ Auth::user()->name }}"
            userEmail="{{ Auth::user()->email }}" />

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree">

            <li class="header">
                {{ __('MAIN NAVIGATION') }}
            </li>

            <li class="@if(Request::segment(1) == 'home') active @endif">
                <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            @hasrole('Admin')
            <li class="treeview">
                <a href="#" onchange="javasctipt:void(0);">
                    <i class="fa fa-users"></i> <span>{{ __('Pengguna') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('user.create')) active @endif">
                        <a href="{{ route('user.create') }}">
                            <i class="fa fa-plus"></i>
                            <span>{{ __('Tambah Pengguna') }}</span>
                        </a>
                    </li>
                    <li class="@if(Route::is('user.index')) active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-list"></i>
                            <span>{{ __('Daftar Pengguna') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-lock"></i>
                            <span>{{ __('Role & Permission') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>{{ __('Kantor Cabang') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('kantor-cabang.create')) active @endif">
                        <a href="{{ route('kantor-cabang.create') }}">
                            <i class="fa fa-plus"></i> {{ __('Tambah Cabang') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('kantor-cabang.index')) active @endif">
                        <a href="{{ route('kantor-cabang.index') }}">
                            <i class="fa fa-list"></i> {{ __('Daftar Cabang') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole

            @hasrole('Admin|Admin ATK')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dropbox"></i>
                    <span>{{ __('Managemen Barang') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('barang.*')) active @endif">
                        <a href="{{ route('barang.index') }}">
                            <i class="fa fa-list"></i> {{ __('Daftar Barang') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('stok-awal.add')) active @endif">
                        <a href="{{ route('stok-awal.add') }}" class="">
                            <i class="fa fa-toggle-on"></i> {{ __('Input Stok Awal') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i> <span>{{ __('Master Inventory') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('stok-opname-barang.*')) active @endif">
                        <a href="{{ route('stok-opname-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Stok Opname') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('jenis-barang.*')) active @endif">
                        <a href="{{ route('jenis-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Jenis Barang') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('satuan-barang.*')) active @endif">
                        <a href="{{ route('satuan-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Satuan Barang') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('supplier.*')) active @endif">
                        <a href="{{ route('supplier.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Supplier') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>{{ __('Data Transaksi') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('barang-masuk.*'))  active @endif">
                        <a href="{{ route('barang-masuk.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Masuk') }}
                        </a>
                    </li>
                    <li class="@if(Route::is('barang-keluar.*')) active @endif">
                        <a href="{{ route('barang-keluar.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Keluar') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole

            @hasrole('Admin|Admin ATK|Manager|Kontrol Internal')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>{{ __('Laporan') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="@if(Request::route()->getName() == 'laporan.stok-barang.index') active @endif">
                        <a href="{{ route('laporan.stok-barang.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Stok Barang') }}
                        </a>
                    </li>

                    <li class="@if(Request::route()->getName() == 'laporan.barang-masuk.index') active @endif">
                        <a href="{{ route('laporan.barang-masuk.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Masuk') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'laporan.barang-keluar.index') active @endif">
                        <a href="{{ route('laporan.barang-keluar.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Barang Keluar') }}
                        </a>
                    </li>
                    <!-- 
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Stok Barang') }}
                        </a>
                    </li>
                    <li class="@if(Request::route()->getName() == 'user.index') active @endif">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> {{ __('Suplier') }}
                        </a>
                    </li>
                    -->
                </ul>
            </li>
            @endhasrole

            <li class="header">
                {{ __('SITE CONFIGURATION') }}
            </li>

            @hasrole('Admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>{{ __('Pengaturan') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(Route::is('settings.general-settings')) active @endif">
                        <a href="{{ route('settings.general-settings') }}">
                            <i class="fa fa-circle-o"></i> <span>{{ __('Pengaturan Situs') }}</span>
                        </a>
                    </li>
                    <li class="@if(Route::is('settings.backup')) active @endif">
                        <a href="{{ route('settings.backup') }}">
                            <i class="fa fa-circle-o"></i> <span>{{ __('Backup Panel') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>