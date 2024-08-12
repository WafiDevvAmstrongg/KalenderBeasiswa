<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Kalender Beasiswa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @auth
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            @endauth
        </div>
    </div> --}}

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item
                {{ Route::is('user.index') ? 'menu-open' : '' }}
                {{ Route::is('level_user.index') ? 'menu-open' : '' }}
                {{ Route::is('tingkat_studi.index') ? 'menu-open' : '' }}
                {{ Route::is('negara.index') ? 'menu-open' : '' }}
                {{ Route::is('pending.index') ? 'menu-open' : '' }}
                {{ Route::is('benua.index') ? 'menu-open' : '' }}">
                {{ Route::is('kalender_beasiswa.index') ? 'menu-open' : '' }}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kalender_beasiswa.index') }}"
                                class="nav-link {{ Route::is('kalender_beasiswa.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kalender Beasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('level_user.index') }}"
                                class="nav-link {{ Route::is('level_user.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tingkat_studi.index') }}"
                                class="nav-link {{ Route::is('tingkat_studi.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tingkat Studi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('negara.index') }}"
                                class="nav-link {{ Route::is('negara.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Negara</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{ route('benua.index') }}"
                                class="nav-link {{ Route::is('benua.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Benua</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pending_kalender') }}"
                                class="nav-link {{ Route::is('pending.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
