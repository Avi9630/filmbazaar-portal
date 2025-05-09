<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box bg-logo">
        <!-- Dark Logo-->
        {{-- <a href="{{ url('/') }}" class="logo">
        <img src="{{ asset('public/admin-iffi/images/nfdc-logo.png') }}" alt="" class="img-fluid"
            style=" width:110px">
        </a> --}}
        <h3 style="color:white">WAVESBAZAAR</h3>
        <!-- Light Logo-->
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav mt-4" id="navbar-nav">
                @if (Route::has('login'))
                @auth

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">DASHBOARD</span>
                    </a>
                </li>

                @can('seller-section')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#film-maker" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="film-maker">
                        <i class="ri-user-2-line"></i> <span data-key="">SELLER</span>
                    </a>
                    <div class="collapse menu-dropdown" id="film-maker">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('film_makers.index') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('film-section')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#film" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="film">
                        <i class="ri-user-2-line"></i> <span data-key="">PROJECT</span>
                    </a>
                    <div class="collapse menu-dropdown" id="film">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('film.fimindex') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('buyer-section')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#film-buyer" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="film-buyer">
                        <i class="ri-user-2-line"></i> <span data-key="">BUYER</span>
                    </a>
                    <div class="collapse menu-dropdown" id="film-buyer">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('film_buyer.index') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#film-buyer-allwoed" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="film-buyer">
                        <i class="ri-user-2-line"></i> <span data-key="">ALLOWED BUYER</span>
                    </a>
                    <div class="collapse menu-dropdown" id="film-buyer-allwoed">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('allowedbuyers.index') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @can('list-user')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarUser">
                        <i class="ri-user-2-line"></i> <span data-key="">USERS</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('list-role')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRole" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarRole">
                        <i class="ri-user-follow-line"></i> <span data-key="">ROLE</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRole">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link" data-key="">LIST
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('list-permission')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Permission" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Permission">
                        <i class="ri-lock-2-line"></i> <span data-key="">PERMISSION</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Permission">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link" data-key="">
                                    LIST </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                @else
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">DASHBOARD</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('login') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">LOGIN</span>
                    </a>
                </li>
                @endauth
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>