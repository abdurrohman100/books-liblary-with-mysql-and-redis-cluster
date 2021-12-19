    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="/">
                                        <img src="/img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">

                                    {{-- navbar  --}}
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            @if(session()->has('isAdmin'))
                                                <li class="med-q-992"><a href="{{ route('home') }}">Home</a></li>
                                            @endif
                                            <li>
                                                <form action="{{ route('search') }}" method="get">
                                                <div class="input-group">
                                                    <input type="search" name="query" class="form-control rounded" placeholder="Search" aria-label="Search"
                                                    aria-describedby="search-addon" />
                                                    <button type="submit" class="boxed-btn3">search</button>
                                                </div>
                                            </form>
                                            </li>
                                            @if(session()->has('login'))
                                                <li class="med-q-992"><a href="{{ route('home') }}">Home</a></li>

                                                <li class="med-q-992">
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <a class="s-log-m" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">Logout</a>
                                                    </form>
                                                </li>
                                            @else
                                                <li class="header-login med-q-992"><a href="{{ route('auth.showLogin') }}">Login</a></li>
                                            @endif

 
                                        </ul>
                                    </nav>
                                    {{-- end of navbar --}}

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    @if(session()->has('login'))
                                    <div class="dropdown-usr">
                                        <button class="dropbtn">{{session('name') }} <i class="ti-angle-down"></i></button>
                                        <div class="dropdown-usr-content">
                                            <a href="{{ route('home') }}">Home</a>
                                            @if(session('isAdmin')== true)
                                            <a href="{{ route('dashboard') }}">Dashboard</a>
                                            @endif
                                            <li class="med-q-992"><a href="{{ route('dashboard') }}">Dashboard</a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <a class="s-log-m" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">Logout</a>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    @else
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="{{ route('auth.showLogin') }}">Login</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
