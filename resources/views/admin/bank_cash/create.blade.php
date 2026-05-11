@extends('adminlte::page')

@section('title', 'Create Bank Cash')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Create Bank Cash</h2>

        <form
            method="POST"
            action="{{ route('admin.bank-cash.store') }}"
        >

            @csrf

            @include('admin.bank_cash._form')

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save
            </button>

            <a
                href="{{ route('admin.bank-cash.index') }}"
                class="btn btn-secondary"
            >
                Back
            </a>

        </form>

    </div>

</div>

@endsection
