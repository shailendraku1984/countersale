@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content')
<h1>Edit Role</h1>

<form method="POST" action="{{ route('rbac.roles.update', $role) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Role Name</label>
        <input type="text" name="name" value="{{ $role->name }}" class="form-control">
    </div>

    <h3>Permissions</h3>

    @foreach($permissions as $module => $perms)
        <div class="card mt-3">
            <div class="card-header">{{ $module }}</div>

            <div class="card-body">
                @foreach($perms as $perm)
                    <label>
                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $perm->id }}"
                               {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                        {{ $perm->name }}
                    </label><br>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="btn btn-primary mt-3">Update</button>
</form>
@endsection