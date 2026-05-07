@extends('adminlte::page')

@section('content')

<br>
<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h2>Warehouse List</h2>

        <a
            href="{{ route('admin.warehouse.create') }}"
            class="btn btn-success"
        >
            Add Warehouse
        </a>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            @foreach($warehouses as $warehouse)

                <tr>

                    <td>{{ $warehouse->id }}</td>

                    <td>{{ $warehouse->warehouse_name }}</td>

                    <td>{{ $warehouse->status }}</td>

                    <td>{{ $warehouse->country->name }}</td>

                    <td>{{ $warehouse->state->name }}</td>

                    <td>{{ $warehouse->city->name }}</td>

                    <td>

                        <a
                            href="{{ route('admin.warehouse.edit', $warehouse->id) }}"
                            class="btn btn-primary btn-sm"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('admin.warehouse.destroy', $warehouse->id) }}"
                            method="POST"
                            style="display:inline-block"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete record?')"
                            >
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    {{ $warehouses->links() }}

</div>

@endsection