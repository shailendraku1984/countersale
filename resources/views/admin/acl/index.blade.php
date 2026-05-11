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
                    <th>Module</th>
                    <th>Action</th>
                     
                </tr>

            </thead>

			<tbody>

		@forelse($permissions as $permission)

			@php

				$modulePermissions = \App\Models\Permission::where('module',$permission->module)->pluck('name');

			@endphp

					<tr>

						<td>
							{{ $permission->module }}
						</td>

						<td>

							@foreach($modulePermissions as $modulePermission)

								<span class="badge badge-primary">

									{{ str_replace($permission->module . '.','',$modulePermission) }}

								</span>

							@endforeach

						</td>

					</tr>

				@empty

					<tr>

						<td colspan="2">
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