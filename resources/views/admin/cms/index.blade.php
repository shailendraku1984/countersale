@extends('adminlte::page')

@section('content')
<br>
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>CMS List</h2>

        <a
            href="{{ route('admin.cms.create') }}"
            class="btn btn-success"
        >
            Add CMS
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Sr</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($cmsPages as $cms)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $cms->title }}</td>

                    <td>{{ $cms->slug }}</td>

                    <td>
                        {{ $cms->is_active ? 'Active' : 'Inactive' }}
                    </td>

                    <td>

                        <a
                            href="{{ route('admin.cms.edit', $cms->id) }}"
                            class="btn btn-primary btn-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.cms.destroy', $cms->id) }}"
                            method="POST"
                            style="display:inline-block"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this record?')"
                            >
                                Delete
                            </button>

                        </form>

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        No records found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{ $cmsPages->links() }}

</div>

@endsection