@extends('adminlte::page')

@section('title', 'Third Party')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between mb-3">

            <h2>Third Party List</h2>

            @can('third-party.create')
                <a
                    href="{{ route('admin.third-party.create') }}"
                    class="btn btn-success"
                >
                    Add Third Party
                </a>
            @endcan

        </div>

        @if(session('success'))
            <div class="alert alert-success mb-0">
                {{ session('success') }}
            </div>
        @endif

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Vendor Code</th>
                        <th>Customer Code</th>
                        <th>Vendor</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($thirdPartyList as $thirdParty)
                        <tr>
                            <td>{{ $thirdPartyList->firstItem() + $loop->index }}</td>
                            <td>{{ $thirdParty->third_party_name }}</td>
                            <td>{{ $thirdParty->typeData->type ?? '-' }}</td>
                            <td>{{ $thirdParty->vendor_code }}</td>
                            <td>{{ $thirdParty->customer_code }}</td>
                            <td>{{ ucfirst($thirdParty->vendor) }}</td>
                            <td>
                                <span class="badge {{ $thirdParty->status === 'open' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ucfirst($thirdParty->status) }}
                                </span>
                            </td>
                            <td>
                                {{ $thirdParty->countryData->name ?? '-' }}
                                @if($thirdParty->stateData)
                                    / {{ $thirdParty->stateData->name }}
                                @endif
                                @if($thirdParty->cityData)
                                    / {{ $thirdParty->cityData->name }}
                                @endif
                            </td>
                            <td>{{ $thirdParty->phone ?? '-' }}</td>
                            <td>
                                @can('third-party.edit')
                                    <a
                                        href="{{ route('admin.third-party.edit', $thirdParty->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                @endcan

                                @can('third-party.delete')
                                    <form
                                        action="{{ route('admin.third-party.destroy', $thirdParty->id) }}"
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
                            <td colspan="10">No Third Party found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $thirdPartyList->links() }}
        </div>

    </div>

</div>

@endsection
