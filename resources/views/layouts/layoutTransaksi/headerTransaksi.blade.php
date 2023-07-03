  <style>
    .navbar{
        background-color: white;
    }
    .navbar-nav{
        position: relative;
        left: 5px;
    }
  </style>
  <!-- ============================================================== -->
  <header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md fixed-top">
        
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto ml-4 pl-2 mb-3 mt-2">
                  <a href="{{ route('dashboard') }}" class="mt-2">
                    <b class="logo-icon">
                        <img src="{{ url('style/image/fanuris.png')}}" alt="homepage" class="dark-logo" width="150px"/>
                    </b>
                </a>

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{  url('style/image/Avatar.png')}}" alt="user" class="rounded-circle"
                            width="40">
                        <span class="ml-2 d-none d-lg-inline-block">
                            <span class="text-dark">Hello, {{ Auth::user()->name }}</span> <i data-feather="chevron-down"class="svg-icon"></i>
                            </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user"
                                class="svg-icon mr-2 ml-1"></i>
                            Profil Saya</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings"
                                class="svg-icon mr-2 ml-1"></i>
                            Pngaturan Akun</a>
                        <a class="dropdown-item" href="{{ route('dashboard') }}"><i data-feather="home"
                                class="svg-icon mr-2 ml-1"></i>
                            Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}""><i data-feather="power"
                                class="svg-icon mr-2 ml-1"></i>
                            Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->