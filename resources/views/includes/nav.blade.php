<!-- Navigation-->
<aside class="navigation">
    <nav>
        <ul class="nav luna-nav">
            <li class="nav-category">
                Dashboard
            </li>

            <li>
                <a href="#account" data-toggle="collapse" aria-expanded="false">
                    Cuenta<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="account" class="nav nav-second collapse">
                    <li><a href="#">Mi perfil</a></li>
                    <li><a href="/dashboard/users/buyCredits">Comprar créditos</a></li>
                </ul>
            </li>
            <li>
                <a href="#publications" data-toggle="collapse" aria-expanded="false">
                    Gauchadas<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="publications" class="nav nav-second collapse">
                    <li><a href="/dashboard/publications/create">Crear</a></li>
                    <li><a href="#">Ver mis Gauchadas</a></li>
                    <li><a href="/dashboard/publications/show/{{1}}">Ver gauchada</a></li>
                </ul>
            </li>
            @if(auth::id()==1)
                <li>
                    <a href="#admin" data-toggle="collapse" aria-expanded="false">
                        Admin<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="admin" class="nav nav-second collapse">
                        <li><a href="#">Ver ganancias</a></li>
                        <li><a href="#">Crear reputaciones</a></li>
                        <li><a href="#">Crear categorias</a></li>
                        <li><a href="#">Setear configuraciones</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </nav>
</aside>
<!-- End navigation-->
