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
            <a class="navbar-brand" href="/dashboard">
                Una Gauchada
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="left-nav-toggle">
                <a href="">
                    <i class="stroke-hamburgermenu"></i>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li style="padding: 10px;" class=" profil-link">

                    <span class="profile-address">{{Session::get('email')}}</span>
                    <img src={{config('app.api_URL').'/images/'.Session::get('profile_picture')}} class="img-circle" alt="">

                    <a style="display: inline-block;" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End header-->