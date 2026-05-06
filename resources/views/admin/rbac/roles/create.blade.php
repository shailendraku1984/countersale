@extends('adminlte::page')

@section('title', 'Create Role')

@section('content')
<h1>Create Role</h1>

<form method="POST" action="{{ route('rbac.roles.store') }}">
    @csrf

    <div class="form-group">
        <label>Role Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <h3>Permissions</h3>

    @foreach($permissions as $module => $perms)
        <div class="card mt-3">
            <div class="card-header">{{ $module }}</div>

            <div class="card-body">
                @foreach($perms as $perm)
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}">
                        {{ $perm->name }}
                    </label><br>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="btn btn-success mt-3">Save</button>
</form>
@endsection