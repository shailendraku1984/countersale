<div class="row">

    <div class="col-md-6">
        <div class="mb-3">
            <label>Ref</label>
            <input
                type="text"
                name="ref"
                class="form-control @error('ref') is-invalid @enderror"
                value="{{ old('ref', $bankCash->ref ?? '') }}"
            >
            @error('ref')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Bank Or Cash Label</label>
            <input
                type="text"
                name="bank_or_cash_label"
                class="form-control @error('bank_or_cash_label') is-invalid @enderror"
                value="{{ old('bank_or_cash_label', $bankCash->bank_or_cash_label ?? '') }}"
            >
            @error('bank_or_cash_label')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Account Type</label>
            <select
                name="account_type"
                class="form-control @error('account_type') is-invalid @enderror"
            >
                <option value="">Select Account Type</option>
                @foreach($accountTypes as $accountType)
                    <option
                        value="{{ $accountType->id }}"
                        @selected(old('account_type', $bankCash->account_type ?? '') == $accountType->id)
                    >
                        {{ $accountType->label }}
                    </option>
                @endforeach
            </select>
            @error('account_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Currency</label>
            <select
                name="currency"
                class="form-control @error('currency') is-invalid @enderror"
            >
                <option value="">Select Currency</option>
                @foreach($currencies as $currency)
                    <option
                        value="{{ $currency->id }}"
                        @selected(old('currency', $bankCash->currency ?? '') == $currency->id)
                    >
                        {{ $currency->label }} ({{ $currency->symbol }})
                    </option>
                @endforeach
            </select>
            @error('currency')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Status</label>
            <select
                name="status"
                class="form-control @error('status') is-invalid @enderror"
            >
                <option value="open" @selected(old('status', $bankCash->status ?? 'open') === 'open')>
                    Open
                </option>
                <option value="close" @selected(old('status', $bankCash->status ?? '') === 'close')>
                    Close
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Country</label>
            <select
                name="country"
                id="country"
                class="form-control @error('country') is-invalid @enderror"
            >
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option
                        value="{{ $country->id }}"
                        @selected(old('country', $bankCash->country ?? '') == $country->id)
                    >
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>State</label>
            <select
                name="state"
                id="state"
                class="form-control @error('state') is-invalid @enderror"
            >
                <option value="">Select State</option>
                @isset($states)
                    @foreach($states as $state)
                        <option
                            value="{{ $state->id }}"
                            @selected(old('state', $bankCash->state ?? '') == $state->id)
                        >
                            {{ $state->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
            @error('state')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>City</label>
            <select
                name="city"
                id="city"
                class="form-control @error('city') is-invalid @enderror"
            >
                <option value="">Select City</option>
                @isset($cities)
                    @foreach($cities as $city)
                        <option
                            value="{{ $city->id }}"
                            @selected(old('city', $bankCash->city ?? '') == $city->id)
                        >
                            {{ $city->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Minimum Allowed Balance</label>
            <input
                type="number"
                step="0.01"
                name="minimum_allowed_balance"
                class="form-control @error('minimum_allowed_balance') is-invalid @enderror"
                value="{{ old('minimum_allowed_balance', $bankCash->minimum_allowed_balance ?? '') }}"
            >
            @error('minimum_allowed_balance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Minimum Desired Balance</label>
            <input
                type="number"
                step="0.01"
                name="minimum_desired_balance"
                class="form-control @error('minimum_desired_balance') is-invalid @enderror"
                value="{{ old('minimum_desired_balance', $bankCash->minimum_desired_balance ?? '') }}"
            >
            @error('minimum_desired_balance')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Bank Name</label>
            <input
                type="text"
                name="bank_name"
                class="form-control @error('bank_name') is-invalid @enderror"
                value="{{ old('bank_name', $bankCash->bank_name ?? '') }}"
            >
            @error('bank_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Account Number</label>
            <input
                type="text"
                name="account_number"
                class="form-control @error('account_number') is-invalid @enderror"
                value="{{ old('account_number', $bankCash->account_number ?? '') }}"
            >
            @error('account_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>IBAN Account Number</label>
            <input
                type="text"
                name="IBAN_account_number"
                class="form-control @error('IBAN_account_number') is-invalid @enderror"
                value="{{ old('IBAN_account_number', $bankCash->IBAN_account_number ?? '') }}"
            >
            @error('IBAN_account_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>SWIFT Code</label>
            <input
                type="text"
                name="SWIFT_code"
                class="form-control @error('SWIFT_code') is-invalid @enderror"
                value="{{ old('SWIFT_code', $bankCash->SWIFT_code ?? '') }}"
            >
            @error('SWIFT_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label>Bank Address</label>
            <textarea
                name="bank_address"
                class="form-control @error('bank_address') is-invalid @enderror"
            >{{ old('bank_address', $bankCash->bank_address ?? '') }}</textarea>
            @error('bank_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Account Owner Name</label>
            <input
                type="text"
                name="account_owner_name"
                class="form-control @error('account_owner_name') is-invalid @enderror"
                value="{{ old('account_owner_name', $bankCash->account_owner_name ?? '') }}"
            >
            @error('account_owner_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Accounting Account</label>
            <input
                type="text"
                name="accounting_account"
                class="form-control @error('accounting_account') is-invalid @enderror"
                value="{{ old('accounting_account', $bankCash->accounting_account ?? '') }}"
            >
            @error('accounting_account')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label>Account Owner Address</label>
            <textarea
                name="account_owner_address"
                class="form-control @error('account_owner_address') is-invalid @enderror"
            >{{ old('account_owner_address', $bankCash->account_owner_address ?? '') }}</textarea>
            @error('account_owner_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('#country').on('change', function () {
        let countryId = $(this).val();

        $('#state').html('<option value="">Loading...</option>');
        $('#city').html('<option value="">Select City</option>');

        if (!countryId) {
            $('#state').html('<option value="">Select State</option>');
            return;
        }

        $.ajax({
            url: "{{ url('admin/bank-cash/states') }}/" + countryId,
            type: 'GET',
            success: function (response) {
                let states = '<option value="">Select State</option>';

                response.forEach(function (state) {
                    states += `<option value="${state.id}">${state.name}</option>`;
                });

                $('#state').html(states);
            }
        });
    });

    $('#state').on('change', function () {
        let stateId = $(this).val();

        $('#city').html('<option value="">Loading...</option>');

        if (!stateId) {
            $('#city').html('<option value="">Select City</option>');
            return;
        }

        $.ajax({
            url: "{{ url('admin/bank-cash/cities') }}/" + stateId,
            type: 'GET',
            success: function (response) {
                let cities = '<option value="">Select City</option>';

                response.forEach(function (city) {
                    cities += `<option value="${city.id}">${city.name}</option>`;
                });

                $('#city').html(cities);
            }
        });
    });
});
</script>
