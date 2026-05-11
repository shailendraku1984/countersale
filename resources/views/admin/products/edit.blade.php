@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Edit Product</h2>

        <form
            method="POST"
            action="{{ route('admin.products.update', $product->id) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('admin.products.form')

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>

    </div>

</div>

@endsection
