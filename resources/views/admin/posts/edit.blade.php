@extends('admin.layout')
@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                POSTS
                <small>Crear Publicación</small>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><i class="fa fa-list"></i> <a href="{{ route('admin.posts.index') }}">Posts</a></li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    @if($post->photos->count() > 0 )
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="row">
                        @foreach($post->photos as $photo)
                            <div class="col-md-2">
                                <form class="form-inline" action="{{ route('admin.photos.destroy', $photo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-danger px-2" style="position: absolute; top: 0; left:10;"><i class="fa fa-times"></i></button>
                                    <img class="w-100" style="" src="{{ Storage::url($photo->url) }}" alt="">
                                </form>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header d-none">
                        <h3 class="card-title">Editar una publicación</h3>
                        <div class="card-tools">
                            <button class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            <button class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Titulo de la publicación</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="ingresa aquí el título de la publicación" autofocus value="{{ old('title', $post->title) }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editor" class="@error('body') text-red @enderror">Contenido de la publicación</label>
                            <textarea name="body" id="editor" class="form-control @error('body') is-invalid @enderror" placeholder="ingresa el contenido completo de la publicación" rows="12">{{ old('body', $post->body) }}</textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editor" class="@error('iframe') text-red @enderror">Contenido embebido (iframe de audio o video)</label>
                            <textarea name="iframe" id="iframe" class="form-control @error('iframe') is-invalid @enderror" placeholder="ingresa contenido embebido de audio o video" rows="2">{{ old('iframe', $post->iframe) }}</textarea>
                            @error('iframe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="" class="card card-outline card-primary">
                    <div class="card-header d-none">
                        <h3 class="card-title">&nbsp;</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Fecha de la publicación:</label>
                            <div class="input-group date" id="published_at" data-target-input="nearest">
                                <input type="text" name="published_at" class="form-control datetimepicker-input" data-target="#published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('d/m/Y') : '') }}"/>
                                <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoría:</label>
                            <select name="category_id" id="category_id" class="form-control select2bs4 @error('category_id') is-invalid @enderror">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    {{--                                <option value="{{ $category->id }}" @if(old('category') == $category->id ) selected @endif>{{ $category->name }}</option>--}}
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Etiquetas</label>
                            <select class="select2bs4 form-control @error('tags') is-invalid @enderror" multiple="multiple" data-placeholder="agrega las etiquetas" name="tags[]">
                                @foreach($tags as $tag)
                                    {{--                                <option value="{{$tag->id}}" @if(in_array($tag->id, old('tags') ?? [])) selected @endif>{{$tag->name}}</option>--}}
                                    <option value="{{$tag->id}}" {{ collect(old('tags', $post->tags->pluck('id')->all()))->contains($tag->id) ? 'selected' : '' }}>{{$tag->name}}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Extracto de la publicación</label>
                            <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" placeholder="ingresa aquí el extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary  btn-block">Guardar Publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css" integrity="sha512-UrCkMTUH0evgGYJJ1Gb5XGuBXDrsSNoyN6Y6OecnEldtTg0TnqZACVJXyEY1wmvf6H8sKET/Yb85cG1xOjSnsw==" crossorigin="anonymous" />
    {{--    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">--}}
    <!-- daterange picker -->
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js" integrity="sha512-/dI6bSNIeJtFs3HvQbyWFDDqwxBNyTi+VDUIcP3bghK8bsaRjVNVIbrgd5mSrf1oAKP1qe9UIX+hIYzqpD+GTg==" crossorigin="anonymous"></script>
    <!-- Moment JS -->
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <!-- date-range-picker -->
    <script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/adminlte/plugins/summernote/lang/summernote-es-ES.min.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function(){
            //Date range picker
            $('#published_at').datetimepicker({
                format: 'DD/MM/YYYY',
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY'),10)-2,
                maxYear: parseInt(moment().format('YYYY'),10),
            });
            // Summernote
            $('#editor').summernote({
                fontName: 'Verdana',
                placeholder: '<em>edita contenido de la publicación aquí</em>',
                tabsize: 2,
                height: "360",
                lang: 'es-ES',
                border: '1px red solid',
                callbacks: {
                    onInit: function() {
                        @error('body')
                        $('#editor').next('.note-editor').css('border','1px red solid');
                        @enderror
                    }
                }
            });
            // $('#editor').summernote('fontName', 'Segoe UI')

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                tags: true,
            });



        });
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            paramName: 'photo',
            dictDefaultMessage: 'Arrastra aquí tus archivos',
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            }
        });

        myDropzone.on('error', function(file, res){

            var msg = res.errors.photo[0];
            $('.dropzone .dz-error-message:last > span').text(msg);
        });

    </script>
@endpush
