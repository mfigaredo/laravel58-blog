<!-- Modal -->
<div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="newPostModalLabel" aria-hidden="true">
    <form action="{{ route('admin.posts.store', '#create') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPostModalLabel">Nuevo Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titulo del post</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="ingresa aquí el título del post" value="{{ old('title') }}" autofocus required>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear publicación</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        console.log('hash', window.location.hash);
        if( window.location.hash == '#create') {
            $('#newPostModal').modal('show');
        }
        $('#newPostModal').on('hide.bs.modal', function() {
            window.location.hash = '#';
        });
        $('#newPostModal').on('shown.bs.modal', function() {
            window.location.hash = '#create';
            $('#newPostModal').find('#title').focus();
        })
    </script>
@endpush
