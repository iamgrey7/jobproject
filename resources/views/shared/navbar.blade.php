<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src={{ asset('img/1.jpg')}} height='50px'>                   
                </a>
                <a class="navbar-brand" href="{{ route('home') }}">        
                    Technolo<span style="color:orange">Geek</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                        
                    @guest
                        {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                        <li><a href="{{ route('home') }}">
                            <i class="fa fa-home"></i> Home</a></li>
                        <li><a id="btnLogin" href=#loginModal class="login-modal" data-toggle="modal" 
                            data-target="#loginModal">
                            <i class="fa fa-unlock"></i> Login</a>                       
                        <li><a href="{{ route('register') }}">
                            <i class="fa fa-user-plus"></i> Daftar</a></li>
                    @else
                    <li><a href="{{ route('home') }}">
                            <i class="fa fa-home"></i> Home</a></li>                           
                        @if(Auth::user()->role_id == '1')
                            <li><a href="{{ route('account.index') }}">
                                <i class="fa fa-users"></i> Kelola User</a></li>
                        @endif

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>