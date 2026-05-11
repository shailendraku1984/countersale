@extends('adminlte::page')

@section('title', 'Products')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between mb-3">

            <h2>Product List</h2>

            @can('products.create')
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    Add Product
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

        <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search name, slug or SKU"
                        value="{{ $filters['search'] ?? '' }}"
                    >
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="open" @selected(($filters['status'] ?? '') === 'open')>Open</option>
                        <option value="close" @selected(($filters['status'] ?? '') === 'close')>Close</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(($filters['category'] ?? '') == $category->id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="branch" class="form-control">
                        <option value="">All Branches</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" @selected(($filters['branch'] ?? '') == $branch->id)>
                                {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="warehouse" class="form-control">
                        <option value="">All Warehouses</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" @selected(($filters['warehouse'] ?? '') == $warehouse->id)>
                                {{ $warehouse->warehouse_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-block">
                        Filter
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Branch</th>
                        <th>Warehouse</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/'.$product->image) }}"
                                        alt="{{ $product->name }}"
                                        style="height: 45px; width: 45px; object-fit: cover;"
                                    >
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->categoryData->category_name ?? '-' }}</td>
                            <td>{{ $product->branchData->branch_name ?? '-' }}</td>
                            <td>{{ $product->warehouseData->warehouse_name ?? '-' }}</td>
                            <td>{{ number_format((float) $product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <span class="badge {{ $product->status === 'open' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>
                                @can('products.edit')
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                @endcan

                                @can('products.delete')
                                    <form
                                        action="{{ route('admin.products.destroy', $product->id) }}"
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
                            <td colspan="11">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>

    </div>

</div>

@endsection
