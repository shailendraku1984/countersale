@extends('adminlte::page')

@section('title', 'ACL List')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            ACL List
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Module</th>
                    <th>Permission</th>
                    <th>Created At</th>

                </tr>

            </thead>

            <tbody>

                @forelse($permissions as $permission)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $permission->module }}
                        </td>

                        <td>
                            {{ $permission->name }}
                        </td>

                        <td>
                            {{ $permission->created_at }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">
                            No ACL found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $permissions->links() }}

        </div>

    </div>

</div>

@endsection