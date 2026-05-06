@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')

@include('admin.users._messages')

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    @include('admin.users._form')

    <button class="btn btn-success">Create</button>
</form>

@stop