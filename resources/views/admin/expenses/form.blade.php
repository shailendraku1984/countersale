<div class="row">

    <div class="col-md-6">
        <div class="mb-3">
            <label>Label</label>
            <input
                type="text"
                name="label"
                class="form-control @error('label') is-invalid @enderror"
                value="{{ old('label', $expense->label ?? '') }}"
            >
            @error('label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Value Date</label>
            <input
                type="date"
                name="value_date"
                class="form-control @error('value_date') is-invalid @enderror"
                value="{{ old('value_date', isset($expense) ? $expense->value_date?->format('Y-m-d') : '') }}"
            >
            @error('value_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Head</label>
            <select name="head" class="form-control @error('head') is-invalid @enderror">
                <option value="">Select Head</option>
                @foreach($heads as $head)
                    <option value="{{ $head->id }}" @selected(old('head', $expense->head ?? '') == $head->id)>
                        {{ $head->name }}
                    </option>
                @endforeach
            </select>
            @error('head')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Department</label>
            <select name="department" class="form-control @error('department') is-invalid @enderror">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" @selected(old('department', $expense->department ?? '') == $department->id)>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Bank Account</label>
            <select name="bank_account" class="form-control @error('bank_account') is-invalid @enderror">
                <option value="">Select Bank Account</option>
                @foreach($bankAccounts as $bankAccount)
                    <option value="{{ $bankAccount->id }}" @selected(old('bank_account', $expense->bank_account ?? '') == $bankAccount->id)>
                        {{ $bankAccount->bank_or_cash_label }}
                    </option>
                @endforeach
            </select>
            @error('bank_account')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Account</label>
            <input
                type="text"
                name="account"
                class="form-control @error('account') is-invalid @enderror"
                value="{{ old('account', $expense->account ?? '') }}"
            >
            @error('account')
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
                id="expense-image"
                class="form-control @error('image') is-invalid @enderror"
                accept="image/*"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="mt-2">
                <img
                    id="image-preview"
                    src="{{ isset($expense) && $expense->image ? asset('storage/'.$expense->image) : '' }}"
                    alt="Expense Image Preview"
                    style="{{ isset($expense) && $expense->image ? '' : 'display:none;' }} max-height: 90px;"
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
            >{{ old('description', $expense->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('#expense-image').on('change', function () {
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
