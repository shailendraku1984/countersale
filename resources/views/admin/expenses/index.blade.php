@extends('adminlte::page')

@section('title', 'Expenses')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between mb-3">

            <h2>Expense List</h2>

            @can('expenses.create')
                <a href="{{ route('admin.expenses.create') }}" class="btn btn-success">
                    Add Expense
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

        <form method="GET" action="{{ route('admin.expenses.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search"
                        value="{{ $filters['search'] ?? '' }}"
                    >
                </div>

                <div class="col-md-2">
                    <select name="head" class="form-control">
                        <option value="">All Heads</option>
                        @foreach($heads as $head)
                            <option value="{{ $head->id }}" @selected(($filters['head'] ?? '') == $head->id)>
                                {{ $head->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="department" class="form-control">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(($filters['department'] ?? '') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="bank_account" class="form-control">
                        <option value="">All Bank Accounts</option>
                        @foreach($bankAccounts as $bankAccount)
                            <option value="{{ $bankAccount->id }}" @selected(($filters['bank_account'] ?? '') == $bankAccount->id)>
                                {{ $bankAccount->bank_or_cash_label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <input
                        type="date"
                        name="date_from"
                        class="form-control"
                        value="{{ $filters['date_from'] ?? '' }}"
                    >
                </div>

                <div class="col-md-1">
                    <input
                        type="date"
                        name="date_to"
                        class="form-control"
                        value="{{ $filters['date_to'] ?? '' }}"
                    >
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('admin.expenses.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Image</th>
                        <th>Label</th>
                        <th>Value Date</th>
                        <th>Head</th>
                        <th>Department</th>
                        <th>Bank Account</th>
                        <th>Account</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expenses->firstItem() + $loop->index }}</td>
                            <td>
                                @if($expense->image)
                                    <img
                                        src="{{ asset('storage/'.$expense->image) }}"
                                        alt="{{ $expense->label }}"
                                        style="height: 45px; width: 45px; object-fit: cover;"
                                    >
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $expense->label }}</td>
                            <td>{{ $expense->value_date?->format('Y-m-d') }}</td>
                            <td>{{ $expense->headData->name ?? '-' }}</td>
                            <td>{{ $expense->departmentData->name ?? '-' }}</td>
                            <td>{{ $expense->bankAccountData->bank_or_cash_label ?? '-' }}</td>
                            <td>{{ $expense->account ?? '-' }}</td>
                            <td>
                                @can('expenses.edit')
                                    <a
                                        href="{{ route('admin.expenses.edit', $expense->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                @endcan

                                @can('expenses.delete')
                                    <form
                                        action="{{ route('admin.expenses.destroy', $expense->id) }}"
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
                            <td colspan="9">No expenses found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $expenses->links() }}
        </div>

    </div>

</div>

@endsection
