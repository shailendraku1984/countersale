<div class="mb-3">
    <label>Warehouse Name</label>

    <input
        type="text"
        name="warehouse_name"
        class="form-control"
        value="{{ old('warehouse_name', $warehouse->warehouse_name ?? '') }}"
    >
</div>

<div class="mb-3">
    <label>Description</label>

    <textarea
        name="description"
        class="form-control"
    >{{ old('description', $warehouse->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Status</label>

    <select
        name="status"
        class="form-control"
    >
        <option value="open">Open</option>
        <option value="close">Close</option>
    </select>
</div>

<div class="mb-3">
    <label>Address</label>

    <textarea
        name="address"
        class="form-control"
    >{{ old('address', $warehouse->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Zipcode</label>

    <input
        type="text"
        name="zipcode"
        class="form-control"
        value="{{ old('zipcode', $warehouse->zipcode ?? '') }}"
    >
</div>

<div class="mb-3">
    <label>Phone</label>

    <input
        type="text"
        name="phone"
        class="form-control"
        value="{{ old('phone', $warehouse->phone ?? '') }}"
    >
</div>

<div class="mb-3">
    <label>Country</label>

    <select
        name="country_id"
        id="country_id"
        class="form-control"
    >
        <option value="">
            Select Country
        </option>

        @foreach($countries as $country)

            <option
                value="{{ $country->id }}"
                @selected(
                    old('country_id', $warehouse->country_id ?? '') == $country->id
                )
            >
                {{ $country->name }}
            </option>

        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>State</label>

    <select
        name="state_id"
        id="state_id"
        class="form-control"
    >
        <option value="">
            Select State
        </option>

        @isset($states)

            @foreach($states as $state)

                <option
                    value="{{ $state->id }}"
                    @selected(
                        old('state_id', $warehouse->state_id ?? '') == $state->id
                    )
                >
                    {{ $state->name }}
                </option>

            @endforeach

        @endisset

    </select>
</div>

<div class="mb-3">
    <label>City</label>

    <select
        name="city_id"
        id="city_id"
        class="form-control"
    >
        <option value="">
            Select City
        </option>

        @isset($cities)

            @foreach($cities as $city)

                <option
                    value="{{ $city->id }}"
                    @selected(
                        old('city_id', $warehouse->city_id ?? '') == $city->id
                    )
                >
                    {{ $city->name }}
                </option>

            @endforeach

        @endisset

    </select>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Country Change
    |--------------------------------------------------------------------------
    */

    $('#country_id').on('change', function () {

        let countryId = $(this).val();

        $('#state_id').html(
            '<option value="">Loading...</option>'
        );

        $('#city_id').html(
            '<option value="">Select City</option>'
        );

        $.ajax({

            url: "{{ url('admin/get-states') }}/" + countryId,

            type: 'GET',

            success: function (response) {

                let states = '<option value="">Select State</option>';

                response.forEach(function (state) {

                    states += `
                        <option value="${state.id}">
                            ${state.name}
                        </option>
                    `;
                });

                $('#state_id').html(states);
            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | State Change
    |--------------------------------------------------------------------------
    */

    $('#state_id').on('change', function () {

        let stateId = $(this).val();

        $('#city_id').html(
            '<option value="">Loading...</option>'
        );

        $.ajax({

            url: "{{ url('admin/get-cities') }}/" + stateId,

            type: 'GET',

            success: function (response) {

                let cities = '<option value="">Select City</option>';

                response.forEach(function (city) {

                    cities += `
                        <option value="${city.id}">
                            ${city.name}
                        </option>
                    `;
                });

                $('#city_id').html(cities);
            }

        });

    });

});

</script>