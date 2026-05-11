@extends('adminlte::page')

@section('title', 'Edit Third Party')

@section('content')

<div class="card">

    <div class="card-body">

        <h2>Edit Third Party</h2>

        <form
            method="POST"
            action="{{ route('admin.third-party.update', $thirdParty->id) }}"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            @include('admin.third_party._form')

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('admin.third-party.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

@endsection
