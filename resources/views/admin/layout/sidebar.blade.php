<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="">
                <img src="{{ asset('assets') }}/img/icon.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Apps</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('produk') ? 'active' : '' }} " href="/produk">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart text-info text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profil') ? 'active' : '' }} " href="/profil">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user text-info text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="nav-link {{ Request::is('logout') ? 'active' : '' }} " href="{{ route('logout') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-sign-out text-info text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
        </div>
    </aside>
