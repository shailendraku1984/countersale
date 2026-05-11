@extends('adminlte::page')

@section('title', 'Edit Expense')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Edit Expense</h2>

        <form
            method="POST"
            action="{{ route('admin.expenses.update', $expense->id) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('admin.expenses.form')

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('admin.expenses.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>

    </div>

</div>

@endsection
