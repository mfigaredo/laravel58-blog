<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">

        <li>
            <a href="{{ route('pages.home') }}" class="text-uppercase pure-menu-link c-gris-2 {{ setActiveRoute('pages.home') }}">Inicio</a>
        </li>
        <li>
            <a href="{{ route('pages.about') }}" class="text-uppercase pure-menu-link c-gris-2 {{ setActiveRoute('pages.about') }}">Nosotros</a>
        </li>
        <li>
            <a href="{{ route('pages.archive') }}" class="text-uppercase pure-menu-link c-gris-2 {{ setActiveRoute('pages.archive') }}">Archivo</a>
        </li>
        <li>
            <a href="{{ route('pages.contact') }}" class="text-uppercase pure-menu-link c-gris-2 {{ setActiveRoute('pages.contact') }}">Contacto</a>
        </li>
        <li>
            <a href="{{ route('login') }}" class="text-uppercase pure-menu-link c-gris-2 {{ setActiveRoute('login') }}">Entrar</a>
        </li>
    </ul>
</nav>
