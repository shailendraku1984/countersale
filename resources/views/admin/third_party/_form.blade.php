<div class="row">

    <div class="col-md-6">
        <div class="mb-3">
            <label>Third Party Name</label>
            <input
                type="text"
                name="third_party_name"
                class="form-control @error('third_party_name') is-invalid @enderror"
                value="{{ old('third_party_name', $thirdParty->third_party_name ?? '') }}"
            >
            @error('third_party_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Third Party Type</label>
            <select
                name="third_party_type"
                class="form-control @error('third_party_type') is-invalid @enderror"
            >
                <option value="">Select Third Party Type</option>
                @foreach($thirdPartyTypes as $thirdPartyType)
                    <option
                        value="{{ $thirdPartyType->id }}"
                        @selected(old('third_party_type', $thirdParty->third_party_type ?? '') == $thirdPartyType->id)
                    >
                        {{ $thirdPartyType->type }}
                    </option>
                @endforeach
            </select>
            @error('third_party_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @isset($thirdParty)
        <div class="col-md-6">
            <div class="mb-3">
                <label>Vendor Code</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $thirdParty->vendor_code }}"
                    readonly
                >
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Customer Code</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $thirdParty->customer_code }}"
                    readonly
                >
            </div>
        </div>
    @endisset

    <div class="col-md-4">
        <div class="mb-3">
            <label>Branch Name</label>
            <input
                type="text"
                name="branch_name"
                class="form-control @error('branch_name') is-invalid @enderror"
                value="{{ old('branch_name', $thirdParty->branch_name ?? '') }}"
            >
            @error('branch_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Vendor</label>
            <select name="vendor" class="form-control @error('vendor') is-invalid @enderror">
                <option value="yes" @selected(old('vendor', $thirdParty->vendor ?? '') === 'yes')>Yes</option>
                <option value="no" @selected(old('vendor', $thirdParty->vendor ?? 'no') === 'no')>No</option>
            </select>
            @error('vendor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="open" @selected(old('status', $thirdParty->status ?? 'open') === 'open')>Open</option>
                <option value="close" @selected(old('status', $thirdParty->status ?? '') === 'close')>Close</option>
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
                        @selected(old('country', $thirdParty->country ?? '') == $country->id)
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
                            @selected(old('state', $thirdParty->state ?? '') == $state->id)
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
                            @selected(old('city', $thirdParty->city ?? '') == $city->id)
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

    <div class="col-md-4">
        <div class="mb-3">
            <label>Baecode</label>
            <input
                type="text"
                name="baecode"
                class="form-control @error('baecode') is-invalid @enderror"
                value="{{ old('baecode', $thirdParty->baecode ?? '') }}"
            >
            @error('baecode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Zipcode</label>
            <input
                type="text"
                name="zipcode"
                class="form-control @error('zipcode') is-invalid @enderror"
                value="{{ old('zipcode', $thirdParty->zipcode ?? '') }}"
            >
            @error('zipcode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Phone</label>
            <input
                type="text"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $thirdParty->phone ?? '') }}"
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Web URL</label>
            <input
                type="url"
                name="web_url"
                class="form-control @error('web_url') is-invalid @enderror"
                value="{{ old('web_url', $thirdParty->web_url ?? '') }}"
            >
            @error('web_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>Sales Tax</label>
            <select name="sales_tax" class="form-control @error('sales_tax') is-invalid @enderror">
                <option value="yes" @selected(old('sales_tax', $thirdParty->sales_tax ?? '') === 'yes')>Yes</option>
                <option value="no" @selected(old('sales_tax', $thirdParty->sales_tax ?? 'no') === 'no')>No</option>
            </select>
            @error('sales_tax')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label>VAT ID</label>
            <input
                type="text"
                name="vat_id"
                class="form-control @error('vat_id') is-invalid @enderror"
                value="{{ old('vat_id', $thirdParty->vat_id ?? '') }}"
            >
            @error('vat_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Third Party Is</label>
            <select name="third_party_is" class="form-control @error('third_party_is') is-invalid @enderror">
                <option value="">Select Third Party Is</option>
                @foreach($thirdPartyIsOptions as $thirdPartyIs)
                    <option
                        value="{{ $thirdPartyIs->id }}"
                        @selected(old('third_party_is', $thirdParty->third_party_is ?? '') == $thirdPartyIs->id)
                    >
                        {{ $thirdPartyIs->name }}
                    </option>
                @endforeach
            </select>
            @error('third_party_is')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Work Force</label>
            <select name="work_force" class="form-control @error('work_force') is-invalid @enderror">
                <option value="">Select Work Force</option>
                @foreach($workForces as $workForce)
                    <option
                        value="{{ $workForce->id }}"
                        @selected(old('work_force', $thirdParty->work_force ?? '') == $workForce->id)
                    >
                        {{ $workForce->label }}
                    </option>
                @endforeach
            </select>
            @error('work_force')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Business Entity Type</label>
            <select name="business_entity_type" class="form-control @error('business_entity_type') is-invalid @enderror">
                <option value="">Select Business Entity Type</option>
                @foreach($businessEntityTypes as $businessEntityType)
                    <option
                        value="{{ $businessEntityType->id }}"
                        @selected(old('business_entity_type', $thirdParty->business_entity_type ?? '') == $businessEntityType->id)
                    >
                        {{ $businessEntityType->label }}
                    </option>
                @endforeach
            </select>
            @error('business_entity_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Capital</label>
            <input
                type="number"
                step="0.01"
                name="capital"
                class="form-control @error('capital') is-invalid @enderror"
                value="{{ old('capital', $thirdParty->capital ?? '') }}"
            >
            @error('capital')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Logo</label>
            <input
                type="file"
                name="logo"
                class="form-control @error('logo') is-invalid @enderror"
                accept="image/*"
            >
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if(isset($thirdParty) && $thirdParty->logo)
                <div class="mt-2">
                    <img
                        src="{{ asset('storage/'.$thirdParty->logo) }}"
                        alt="Third Party Logo"
                        style="max-height: 80px;"
                    >
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label>Address</label>
            <textarea
                name="address"
                class="form-control @error('address') is-invalid @enderror"
                rows="3"
            >{{ old('address', $thirdParty->address ?? '') }}</textarea>
            @error('address')
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
            url: "{{ url('admin/third-party/states') }}/" + countryId,
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
            url: "{{ url('admin/third-party/cities') }}/" + stateId,
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
