@extends('adminlte::page')

@section('title', 'Categories')

@section('content')

<div class="card">

    <div class="card-header">

    <div class="d-flex justify-content-between mb-3">

        <h2>Categories List</h2>
        
		@can('category.create')
        <a
            href="{{ route('admin.category.create') }}"
            class="btn btn-success"
        >
            Add Category
        </a>
        @endcan
    </div>
	
	
         

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Sr</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $category->category_name }}
                        </td>

                        <td>
                            {{ $category->parent?->category_name }}
                        </td>

                        <td>

                            @can('category.edit')

                                <a
                                    href="{{ route('admin.category.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                            @endcan

                            @can('category.delete')

                                <form
                                    action="{{ route('admin.category.destroy', $category->id) }}"
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
                            No categories found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $categories->links() }}

        </div>

    </div>

</div>

@endsection