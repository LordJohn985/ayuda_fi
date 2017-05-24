<!-- Header-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <div id="mobile-menu">
                <div class="left-nav-toggle">
                    <a href="#">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
                </div>
            </div>
            <a class="navbar-brand" href="/">
                Una Gauchada
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="left-nav-toggle">
                <a href="">
                    <i class="stroke-hamburgermenu"></i>
                </a>
            </div>
        @if (Auth::user()   ) <!-- header when user is logged in-->
            <div class="collapse navbar-collapse" id="myNavbarON">
                @if(auth::id()==1)
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard/users/create">Crear</a></li>
                                <li><a href="/dashboard/users/list">Listar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorías<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard/categories/create">Crear</a></li>
                                <li><a href="/dashboard/categories/list">Listar</a></li>
                            </ul></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Publicaciones<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/dashboard/publications/create">Crear</a></li>
                                <li><a href="/dashboard/publications/list">Listar</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        @else  <!-- header when user is not logged in-->
            <div class="collapse navbar-collapse" id="myNavbarON">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>

            @endif
        </div>

    </div>
</nav>