@extends('admin.layout')

@section('content')
{{--    {{ $user->posts }}--}}
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="/adminlte/img/user4-128x128.jpg"
                             alt="{{ $user->name }}">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Publicaciones</b> <a class="float-right">{{ $user->posts->count() }}</a>
                        </li>
                        @if($user->roles->count())
                            <li class="list-group-item">
                                <b>Roles</b> <a class="float-right">{{ $user->getRoleNames()->implode(', ') }}</a>
                            </li>
                        @endif
                    </ul>

                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-block"><b>Editar</b></a>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-outline card-success">
                <div class="card-header with-border">

                    <div class="card-title">
                        Publicaciones
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->posts as $post)
                        <a href="{{ route('posts.show', $post) }}" target="_blank">

                            <strong>{{ $post->title }}</strong>
                        </a>

                        <br>
                        <small class="text-muted">Publicado el {{ $post->published_at ? $post->published_at->format('d/m/Y') : 'pendiente' }}</small>
                        <p class="text-muted">{{ $post->excerpt }}</p>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">Sin publicaciones todavía.</small>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-outline card-danger">
                <div class="card-header with-border">

                    <div class="card-title">
                        Roles
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->roles as $role)
                        <strong>{{ $role->name }}</strong>
                        @if($role->permissions->count())
                        <br>
                        <small class="text-muted">Permisos {{ $role->permissions->pluck('name')->implode(', ') }}</small>
                        @endif
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene roles asignados.</small>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-outline card-warning">
                <div class="card-header with-border">

                    <div class="card-title">
                        Permisos Adicionales
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->permissions as $permission)
                        <strong>{{ $permission->name }}</strong>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene permisos adicionales.</small>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
