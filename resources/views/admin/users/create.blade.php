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

                    @include('partials.error-messages')

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        {{--                        <input type="hidden" name="user_id" value="{{ $user->id }}">--}}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="row">


                            <div class="form-group col-6">
                                <label>Roles</label>
                                @include('admin.roles.checkboxes')
                            </div>
                            <div class="form-group col-6">
                                <label>Permisos</label>
                                @include('admin.permissions.checkboxes', ['model' => $user])
                            </div>
                        </div>
                        <span class="help-block small mb-3 d-block">La contraseña será generada y enviada al usuario vía email.</span>
                        <button class="btn btn-primary btn-block">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
