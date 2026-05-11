@extends('adminlte::page')

@section('title', 'Create Third Party')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Create Third Party</h2>

        <form
            method="POST"
            action="{{ route('admin.third-party.store') }}"
            enctype="multipart/form-data"
        >

            @csrf

            @include('admin.third_party._form')

            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('admin.third-party.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection
