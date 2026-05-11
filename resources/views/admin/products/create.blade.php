@extends('adminlte::page')

@section('title', 'Create Product')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Create Product</h2>

        <form
            method="POST"
            action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            @include('admin.products.form')

            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>

    </div>

</div>

@endsection
