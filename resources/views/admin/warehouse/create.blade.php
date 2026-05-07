@extends('adminlte::page')

@section('content')

<div class="container">

    <h2>Create Warehouse</h2>

    <form
        action="{{ route('admin.warehouse.store') }}"
        method="POST"
    >
        @csrf

        @include('admin.warehouse.form')

        <button
            type="submit"
            class="btn btn-primary"
        >
            Save
        </button>

    </form>

</div>

@endsection