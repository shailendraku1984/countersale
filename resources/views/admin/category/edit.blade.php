@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content')

<div class="card">
 

    <div class="card-body">
	    <h2>Edit Category</h2>

        <form
            method="POST"
            action="{{ route('admin.category.update', $category->id) }}"
        >

            @csrf
            @method('PUT')

            @include('admin.category._form')

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update
            </button>

        </form>

    </div>

</div>

@endsection