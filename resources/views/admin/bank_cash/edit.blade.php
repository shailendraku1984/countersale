@extends('adminlte::page')

@section('title', 'Edit Bank Cash')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Edit Bank Cash</h2>

        <form
            method="POST"
            action="{{ route('admin.bank-cash.update', $bankCash->id) }}"
        >

            @csrf
            @method('PUT')

            @include('admin.bank_cash._form')

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update
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
