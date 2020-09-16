@extends('admin.layout')
{{--@section('page_title', 'Todos los Posts')--}}
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Roles
                <small>Listado</small>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Todos los roles</h3>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Crear Role</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="roles-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <strong>{{ $role->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $role->display_name }}</td>
                        <td>
{{--                            {{ $role->permissions->pluck('display_name')->implode(', ') }}--}}
{{--                            <br>--}}
                            {!!  $role->permissions->map(function($item, $key) {
                                return $item->display_name ?: '<small>' . $item->name . '</small>';
                            })->implode(', ')  !!}
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-default btn-xs mr-2 border-dark">
                                <i class="fa fa-eye"></i>
                            </a>
                            {{--                            @can('update', $role)--}}
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-info btn-xs mr-2">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            {{--                            @endcan--}}
                            {{--                            @can('delete', $role)--}}
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-xs mr-2" onclick="return confirm('¿Estás seguro de querer eliminar este role?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            {{--                            @endcan--}}


                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@push('styles')    {{-- en layout carga con @stack --}}
@include('partials.datatables-styles')
@endpush

@push('scripts')
    @include('partials.datatables-script')
    <!-- page script -->
    <script>
        $(function () {

            $('#roles-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
    </script>
@endpush


