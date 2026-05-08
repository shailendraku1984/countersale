@extends('adminlte::page')

@section('title', 'Create Category')

@section('content')

<div class="card">

	

    <div class="card-body">
        <h2>Create Category</h2>
		
        <form
            method="POST"
            action="{{ route('admin.category.store') }}"
        >

            @csrf

            @include('admin.category._form')

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save
            </button>

        </form>

    </div>

</div>

@endsection