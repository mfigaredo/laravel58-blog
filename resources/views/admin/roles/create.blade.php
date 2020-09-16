@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-6 offset-0">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        Crear Role
                    </h3>
                </div>
                <div class="card-body">
                    @include('partials.error-messages')
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @include('admin.roles.form')
                        <button class="btn btn-primary btn-block">Crear Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
