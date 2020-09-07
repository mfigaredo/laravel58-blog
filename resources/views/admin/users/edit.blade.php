@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-6 offset-0">
            <div class="card card-primary card-outline">
               <div class="card-header with-border">
                   <h3 class="card-title">
                       Datos Personales
                   </h3>
               </div>
                <div class="card-body">

                    @if($errors->any())
                        <ul class="list-group mb-3">

                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf @method('PUT')
{{--                        <input type="hidden" name="user_id" value="{{ $user->id }}">--}}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" class="form-control" value="" placeholder="Contraseña">
                            <small class="text-muted">Dejar en blanco si no quieres cambiar la contraseña.</small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control" value="" placeholder="Repite la contraseña">
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 offset-0">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        Roles
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.roles.update', $user) }}" method="POST">
                        @csrf @method('PUT')
                        @foreach($roles as $role)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="mr-2" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : ''  }}>
                                    {{ $role->name }} <br>
                                    <small class="text-muted">
                                        {{ $role->permissions->pluck('name')->implode(', ') }}
                                    </small>
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-block">Actualizar Roles</button>
                    </form>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        Permisos
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.permissions.update', $user) }}" method="POST">
                        @csrf @method('PUT')
                        @foreach($permissions as $id => $name)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $id }}" {{ $user->permissions->contains($id) ? 'checked' : ''  }}>
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-block">Actualizar Permisos</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
