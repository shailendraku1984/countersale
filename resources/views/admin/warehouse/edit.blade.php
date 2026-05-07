@extends('adminlte::page')

@section('content')

<div class="container">

    <h2>Edit Warehouse</h2>

    <form
        action="{{ route('admin.warehouse.update', $warehouse->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        @include('admin.warehouse.form')

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update
        </button>

    </form>

</div>

@endsection