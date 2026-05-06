@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')

@include('admin.users._messages')

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    @include('admin.users._form')

    <button class="btn btn-primary">Update</button>
</form>

@stop