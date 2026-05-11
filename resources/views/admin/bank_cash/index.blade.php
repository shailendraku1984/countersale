@extends('adminlte::page')

@section('title', 'Bank Cash')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between mb-3">

            <h2>Bank Cash List</h2>

            @can('bank-cash.create')
                <a
                    href="{{ route('admin.bank-cash.create') }}"
                    class="btn btn-success"
                >
                    Add Bank Cash
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
                        <th>Ref</th>
                        <th>Label</th>
                        <th>Account Type</th>
                        <th>Currency</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bankCashList as $bankCash)

                        <tr>

                            <td>
                                {{ $bankCashList->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $bankCash->ref }}
                            </td>

                            <td>
                                {{ $bankCash->bank_or_cash_label }}
                            </td>

                            <td>
                                {{ $bankCash->accountType->label ?? '-' }}
                            </td>

                            <td>
                                {{ $bankCash->currencyData->label ?? '-' }}
                                @if($bankCash->currencyData?->symbol)
                                    ({{ $bankCash->currencyData->symbol }})
                                @endif
                            </td>

                            <td>
                                <span class="badge {{ $bankCash->status === 'open' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ucfirst($bankCash->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $bankCash->countryData->name ?? '-' }}
                                @if($bankCash->stateData)
                                    / {{ $bankCash->stateData->name }}
                                @endif
                                @if($bankCash->cityData)
                                    / {{ $bankCash->cityData->name }}
                                @endif
                            </td>

                            <td>
                                {{ $bankCash->bank_name ?? '-' }}
                            </td>

                            <td>
                                {{ $bankCash->account_number ?? '-' }}
                            </td>

                            <td>

                                @can('bank-cash.edit')
                                    <a
                                        href="{{ route('admin.bank-cash.edit', $bankCash->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                @endcan

                                @can('bank-cash.delete')
                                    <form
                                        action="{{ route('admin.bank-cash.destroy', $bankCash->id) }}"
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
                            <td colspan="10">
                                No Bank Cash found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $bankCashList->links() }}

        </div>

    </div>

</div>

@endsection
