<!-- Navigation-->
<aside class="navigation" style="position: fixed">
    <nav>
        <ul class="nav luna-nav">
            <li class="nav-category">
                Dashboard
            </li>

            {{--Account Options--}}
            <li>
                <a href="#account" data-toggle="collapse" aria-expanded="false">
                    Cuenta<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="account" class="nav nav-second collapse">
                    <li><a href="/user/{{auth::id()}}">Mi perfil</a></li>
                    <li><a href="/dashboard/users/buyCredits">Comprar créditos</a></li>
                    <li><a href="/dashboard/users/deleteAccount" onclick="return confirm('¿Esta seguro que desea borrar su cuenta?')">Borrar cuenta</a></li>
                </ul>
            </li>

            {{--Publications options--}}
            <li>
                <a href="#publications" data-toggle="collapse" aria-expanded="false">
                    Gauchadas<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="publications" class="nav nav-second collapse">
                    <li><a href="/dashboard/publications/create">Crear</a></li>
                    <li><a href="/user/publications/{{Auth::id()}}">Mis gauchadas</a></li>
                    <li><a href="/user/postulations/{{Auth::id()}}">Mis postulaciones</a></li>
                </ul>
            </li>

            {{--Admin options--}}
            @if(auth::id()==1)
                <li>
                    <a href="#admin" data-toggle="collapse" aria-expanded="false">
                        Admin<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="admin" class="nav nav-second collapse">
                        <li><a href="/earnings/getAllPurchases">Ver ganancias</a></li>
                        <li><a href="/reputations">Reputaciones</a></li>
                        <li><a href="/dashboard/categories/list">Categorias</a></li>
                        <li><a href="/ranking">Ver ranking</a></li>
                        <li><a href="/logs">Logs</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </nav>
</aside>
<!-- End navigation-->
