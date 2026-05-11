@extends('adminlte::page')

@section('title', 'Create Branch')

@section('content')

<div class="card">

	

    <div class="card-body">
        <h2>Create Branch</h2>
		
        <form
            method="POST"
            action="{{ route('admin.branch.store') }}"
        >

            @csrf

            @include('admin.branch._form')

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