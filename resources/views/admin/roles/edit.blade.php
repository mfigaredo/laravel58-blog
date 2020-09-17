@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-6 offset-0">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        Editar Role
                    </h3>
                </div>
                <div class="card-body">

                    @include('partials.error-messages')

                    <form action="{{ route('admin.roles.update', ['role' => $role]) }}" method="POST">
                        @method('PUT')
                        @include('admin.roles.form')
                        <button class="btn btn-primary btn-block">Actualizar Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <a href="{{ route('admin.roles.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>  Lista Roles</a>
        </div>
    </div>
@endsection

