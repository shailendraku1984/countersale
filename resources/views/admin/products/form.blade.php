<div class="row">

    <div class="col-md-6">
        <div class="mb-3">
            <label>Name</label>
            <input
                type="text"
                name="name"
                id="product-name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name ?? '') }}"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Slug</label>
            <input
                type="text"
                name="slug"
                id="product-slug"
                class="form-control @error('slug') is-invalid @enderror"
                value="{{ old('slug', $product->slug ?? '') }}"
            >
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>SKU</label>
            <input
                type="text"
                name="sku"
                class="form-control @error('sku') is-invalid @enderror"
                value="{{ old('sku', $product->sku ?? '') }}"
            >
            @error('sku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Category</label>
            <select name="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category', $product->category ?? '') == $category->id)>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Branch</label>
            <select name="branch" class="form-control @error('branch') is-invalid @enderror">
                <option value="">Select Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" @selected(old('branch', $product->branch ?? '') == $branch->id)>
                        {{ $branch->branch_name }}
                    </option>
                @endforeach
            </select>
            @error('branch')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Warehouse</label>
            <select name="warehouse" class="form-control @error('warehouse') is-invalid @enderror">
                <option value="">Select Warehouse</option>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" @selected(old('warehouse', $product->warehouse ?? '') == $warehouse->id)>
                        {{ $warehouse->warehouse_name }}
                    </option>
                @endforeach
            </select>
            @error('warehouse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>For Sale</label>
            <select name="forSale" class="form-control @error('forSale') is-invalid @enderror">
                <option value="">Select Sale Option</option>
                @foreach($forSales as $forSale)
                    <option value="{{ $forSale->id }}" @selected(old('forSale', $product->forSale ?? '') == $forSale->id)>
                        {{ $forSale->title }}
                    </option>
                @endforeach
            </select>
            @error('forSale')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>For Purchase</label>
            <select name="forPurchase" class="form-control @error('forPurchase') is-invalid @enderror">
                <option value="">Select Purchase Option</option>
                @foreach($forPurchases as $forPurchase)
                    <option value="{{ $forPurchase->id }}" @selected(old('forPurchase', $product->forPurchase ?? '') == $forPurchase->id)>
                        {{ $forPurchase->title }}
                    </option>
                @endforeach
            </select>
            @error('forPurchase')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Tax Rate</label>
            <select name="tax_rate" class="form-control @error('tax_rate') is-invalid @enderror">
                <option value="">Select Tax Rate</option>
                @foreach($taxRates as $taxRate)
                    <option value="{{ $taxRate->id }}" @selected(old('tax_rate', $product->tax_rate ?? '') == $taxRate->id)>
                        {{ $taxRate->label }}
                    </option>
                @endforeach
            </select>
            @error('tax_rate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="open" @selected(old('status', $product->status ?? 'open') === 'open')>Open</option>
                <option value="close" @selected(old('status', $product->status ?? '') === 'close')>Close</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Price</label>
            <input
                type="number"
                step="0.01"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}"
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Stock</label>
            <input
                type="number"
                name="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? '') }}"
            >
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Product Color</label>
            <select name="product_color" class="form-control @error('product_color') is-invalid @enderror">
                <option value="">Select Color</option>
                @foreach($productColors as $productColor)
                    <option value="{{ $productColor->id }}" @selected(old('product_color', $product->product_color ?? '') == $productColor->id)>
                        {{ $productColor->name }}
                    </option>
                @endforeach
            </select>
            @error('product_color')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Product Size</label>
            <select name="product_size" class="form-control @error('product_size') is-invalid @enderror">
                <option value="">Select Size</option>
                @foreach($productSizes as $productSize)
                    <option value="{{ $productSize->id }}" @selected(old('product_size', $product->product_size ?? '') == $productSize->id)>
                        {{ $productSize->title }}
                    </option>
                @endforeach
            </select>
            @error('product_size')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Image</label>
            <input
                type="file"
                name="image"
                id="product-image"
                class="form-control @error('image') is-invalid @enderror"
                accept="image/*"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="mt-2">
                <img
                    id="image-preview"
                    src="{{ isset($product) && $product->image ? asset('storage/'.$product->image) : '' }}"
                    alt="Product Image Preview"
                    style="{{ isset($product) && $product->image ? '' : 'display:none;' }} max-height: 90px;"
                >
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label>Description</label>
            <textarea
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="4"
            >{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
$(document).ready(function () {
    let slugTouched = $('#product-slug').val().length > 0;

    $('#product-slug').on('input', function () {
        slugTouched = true;
    });

    $('#product-name').on('input', function () {
        if (slugTouched) {
            return;
        }

        let slug = $(this).val()
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        $('#product-slug').val(slug);
    });

    $('#product-image').on('change', function () {
        let file = this.files[0];

        if (!file) {
            $('#image-preview').hide();
            return;
        }

        let reader = new FileReader();

        reader.onload = function (event) {
            $('#image-preview')
                .attr('src', event.target.result)
                .show();
        };

        reader.readAsDataURL(file);
    });
});
</script>
