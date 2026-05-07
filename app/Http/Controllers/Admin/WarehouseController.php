<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Services\WarehouseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;

class WarehouseController extends Controller
{
    protected WarehouseService $service;

    public function __construct(
        WarehouseService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $warehouses = $this->service->getAll();

        return view(
            'admin.warehouse.index',
            compact('warehouses')
        );
    }

    public function create()
    {
        $countries = Country::all();

        return view(
            'admin.warehouse.create',
            compact('countries')
        );
    }

    public function store(StoreWarehouseRequest $request)
    {
        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.warehouse.index')
            ->with(
                'success',
                'Warehouse created successfully.'
            );
    }

    public function edit(int $id)
    {
        $warehouse = $this->service->find($id);

        $countries = Country::all();

        $states = State::where(
            'country_id',
            $warehouse->country_id
        )->get();

        $cities = City::where(
            'state_id',
            $warehouse->state_id
        )->get();

        return view(
            'admin.warehouse.edit',
            compact(
                'warehouse',
                'countries',
                'states',
                'cities'
            )
        );
    }

    public function update(
        UpdateWarehouseRequest $request,
        int $id
    ) {
        $this->service->update(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('admin.warehouse.index')
            ->with(
                'success',
                'Warehouse updated successfully.'
            );
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('admin.warehouse.index')
            ->with(
                'success',
                'Warehouse deleted successfully.'
            );
    }
	
	
	public function getStates($countryId)
	{
		$states = \App\Models\State::where(
			'country_id',
			$countryId
		)->get();

		return response()->json($states);
	}

	public function getCities($stateId)
	{
		$cities = \App\Models\City::where(
			'state_id',
			$stateId
		)->get();

		return response()->json($cities);
	}

}