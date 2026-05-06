@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

@include('admin.users._messages')

<div class="mb-3">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        Add User
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sr</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th width="150">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Delete user?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No users found</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $users->links() }}
</div>

@stop