@extends('adminlte::page')

@section('content')

<div class="container">

    <h2>Create CMS</h2>

    <form
        action="{{ route('admin.cms.store') }}"
        method="POST"
    >
        @csrf

        @include('admin.cms.form')

    </form>

</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection