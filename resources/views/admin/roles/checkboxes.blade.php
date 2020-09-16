@foreach($roles as $role)
    <div class="checkbox">
        <label>
            <input type="checkbox" class="mr-2" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : ''  }}>
            {{ $role->name }} <br>
            <small class="text-muted">
                {{ $role->permissions->pluck('name')->implode(', ') }}
            </small>
        </label>
    </div>
@endforeach
