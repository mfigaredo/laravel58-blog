@csrf
<div class="form-group">
    <label for="name">Identificador:</label>
    @if($role->exists)
        <input type="text" disabled class="form-control" value="{{  $role->name }}">
    @else
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $role->name) }}">
    @endif
</div>
<div class="form-group">
    <label for="display_name">Nombre:</label>

    <input type="text" name="display_name" id="display_name" class="form-control" value="{{ old('display_name', $role->display_name) }}">
</div>
<div class="form-group d-none">
    <label for="guard_name">Guard:</label>
    <select name="guard_name" id="guard_name" class="form-control">
        @foreach( config('auth.guards') as $guardName => $guard )
            <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }} value="{{ $guardName }}">{{ $guardName }}</option>
        @endforeach
    </select>
</div>

<div class="row">

    <div class="form-group col-6">
        <label>Permisos</label>
        @include('admin.permissions.checkboxes', ['model' => $role])
    </div>
</div>
