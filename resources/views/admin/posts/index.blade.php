@extends('admin.layout')
{{--@section('page_title', 'Todos los Posts')--}}
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                POSTS
                <small>Listado</small>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Todas las publicaciones</h3>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#newPostModal"><i class="fa fa-plus"></i> Crear Publicación</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Extracto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>
                                <a href="{{ route('blog.show', $post) }}" class="btn btn-default btn-xs" target="_post">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                </a>
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

            $('#posts-table').DataTable({
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
