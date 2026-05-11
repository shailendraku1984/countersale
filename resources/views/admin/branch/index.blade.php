@extends('adminlte::page')

@section('title', 'Branch')

@section('content')

<div class="card">

    <div class="card-header">

    <div class="d-flex justify-content-between mb-3">

        <h2>Branch List</h2>
        
		@can('branch.create')
        <a
            href="{{ route('admin.branch.create') }}"
            class="btn btn-success"
        >
            Add Branch
        </a>
        @endcan
    </div>
	
	
         

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Sr</th>
                    <th>Branch</th>
                    <th>Address</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($branches as $branch)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $branch->branch_name }}
                        </td>

                        <td>
                            {{ $branch->address}}
                        </td>

                        <td>

                            @can('branch.edit')

                                <a
                                    href="{{ route('admin.branch.edit', $branch->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                            @endcan

                            @can('branch.delete')

                                <form
                                    action="{{ route('admin.branch.destroy', $branch->id) }}"
                                    method="POST"
                                    style="display:inline-block;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')"
                                    >
                                        Delete
                                    </button>

                                </form>

                            @endcan

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">
                            No Branch found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $branches->links() }}

        </div>

    </div>

</div>

@endsection