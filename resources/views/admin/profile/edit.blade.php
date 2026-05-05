@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Update Profile</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>

        <button type="submit">Update</button>
    </form>
</div>
@endsection