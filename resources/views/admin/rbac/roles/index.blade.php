@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<h1>Roles</h1>

<a href="{{ route('rbac.roles.create') }}" class="btn btn-primary">Create Role</a>


<table class="table mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>

                <td>
                    {{ $role->permissions->pluck('name')->implode(', ') }}
                </td>

                <td>
                    <a href="{{ route('rbac.roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection