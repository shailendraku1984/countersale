@extends('adminlte::page')

@section('title', 'Assign Role')

@section('content')
<h1>Assign Role to User</h1>

<form method="POST" action="{{ route('rbac.users.roles.assign', $user) }}">
    @csrf

    <div class="form-group">
        <label>User</label>
        <input type="text" value="{{ $user->name }}" class="form-control" disabled>
    </div>

    <div class="form-group">
        <label>Select Roles</label>

        @foreach($roles as $role)
            <div>
                <input type="checkbox"
                       name="roles[]"
                       value="{{ $role->id }}"
                       {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                {{ $role->name }}
            </div>
        @endforeach
    </div>

    <button class="btn btn-success">Assign</button>
</form>
@endsection