<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ setActiveRoute('dashboard')  }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Inicio
{{--                <span class="right badge badge-danger">New</span>--}}
            </p>
        </a>
    </li>
{{--    request()->is('admin/posts*') ? 'menu-open' : ''--}}
    <li class="nav-item has-treeview {{ setActiveRoute('admin/posts*', 'menu-open') }}">
        <a href="#" class="nav-link {{ setActiveRoute('admin.posts.index') }}">
            <i class="nav-icon fas fa-bars"></i>
            <p>
                Blog
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ setActiveRoute('admin.posts.index') }}">
                    <i class="fas fa-eye nav-icon"></i>
                    <p>Ver todos los posts</p>
                </a>
            </li>
            <li class="nav-item">
                @if(request()->is('admin/posts/*'))
                    <a href="{{ route('admin.posts.index', '#create') }}" class="nav-link">
                        <i class="far fa-edit nav-icon"></i>
                        <p>Crear post</p>
                    </a>
                @else
                    <a href="#" class="nav-link"  data-toggle="modal" data-target="#newPostModal">
                        <i class="far fa-edit nav-icon"></i>
                        <p>Crear post</p>
                    </a>
                @endif
            </li>
        </ul>
    </li>
{{--    request()->is('admin/users*') ? 'menu-open' : ''--}}
    <li class="nav-item has-treeview {{ setActiveRoute(['admin.users.index','admin.users.create'], 'menu-open') }}">
        <a href="#" class="nav-link {{ setActiveRoute('admin/users*') }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index') }}">
                    <i class="fas fa-eye nav-icon"></i>
                    <p>Ver todos los usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.create') }}" class="nav-link {{ setActiveRoute('admin.users.create') }}">
                    <i class="far fa-edit nav-icon"></i>
                    <p>Crear un usuario</p>
                </a>

            </li>
        </ul>
    </li>


    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>
</ul>
