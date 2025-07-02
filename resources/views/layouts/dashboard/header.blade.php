<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                {{-- <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset("images/brand/favicon.ico")}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a> --}}

                <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset("images/brand/favicon.ico")}}" alt="" height="48" onerror="this.remove();">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset("images/brand")}}/{{TE::system('logo', 'logo.png')}}" alt="{{ TE::system('title', env('APP_NAME')) }}" height="70" width="240" onerror="this.remove();">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('images/user')}}/{{ auth()->user()->details->image }}" alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{route('account')}}"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" onclick="document.getElementById('logout').submit()">
                        <i class="mdi mdi-power font-size-17 align-middle me-1 text-danger"></i> Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
    <form id="logout" action="{{route('logout')}}" method="post">
        @csrf
    </form>
</header>