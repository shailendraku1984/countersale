@extends('adminlte::page')

@section('title', 'Edit Branch')

@section('content')

<div class="card">
 

    <div class="card-body">
	    <h2>Edit Branch</h2>

        <form
            method="POST"
            action="{{ route('admin.branch.update', $branch->id) }}"
        >

            @csrf
            @method('PUT')

            @include('admin.branch._form')

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