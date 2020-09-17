@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-6 offset-0">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        Editar Permiso
                    </h3>
                </div>
                <div class="card-body">

                    @include('partials.error-messages')

                    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                        @method('PUT')  @csrf
                        <div class="form-group">
                            <label>Identificador:</label>
                            <input type="text" disabled value="{{ $permission->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="display_name">Nombre:</label>

                            <input type="text" name="display_name" id="display_name" class="form-control" value="{{ old('display_name', $permission->display_name) }}">
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar Permiso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <a href="{{ route('admin.permissions.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>  Lista Permisos</a>
        </div>
    </div>
@endsection

