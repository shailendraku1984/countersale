@extends('adminlte::page')

@section('title', 'Create Expense')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Create Expense</h2>

        <form
            method="POST"
            action="{{ route('admin.expenses.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            @include('admin.expenses.form')

            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('admin.expenses.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>

    </div>

</div>

@endsection
