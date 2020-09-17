@extends('admin.layout')
{{--@section('page_title', 'Todos los Posts')--}}
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Permisos
                <small>Listado</small>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Todos los Permisos</h3>
{{--            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Crear Permiso</a>--}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="permissions-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificador</th>
                    <th>Nombre</th>
{{--                    <th>Permisos</th>--}}
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td class="d-flex flex-row justify-content-between align-items-center">
                            <div>
                                <strong>{{ $permission->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $permission->display_name }}</td>
                        {{--
                        <td>
                                                        {{ $role->permissions->pluck('display_name')->implode(', ') }}
                                                        <br>
                            {!!  $role->permissions->map(function($item, $key) {
                                return $item->display_name ?: '<small>' . $item->name . '</small>';
                            })->implode(', ')  !!}
                        </td>
                        --}}
                        <td>

                            @can('update', $permission)
                            <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-info btn-xs mr-2">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            @endcan

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

            $('#permissions-table').DataTable({
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



