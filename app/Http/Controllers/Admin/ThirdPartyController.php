<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreThirdPartyRequest;
use App\Http\Requests\UpdateThirdPartyRequest;
use App\Models\BusinessEntityType;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\ThirdParty;
use App\Models\ThirdPartyIs;
use App\Models\ThirdPartyType;
use App\Models\WorkForce;
use App\Services\Contracts\ThirdPartyServiceInterface;

class ThirdPartyController extends Controller
{
    protected ThirdPartyServiceInterface $service;

    public function __construct(ThirdPartyServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $thirdPartyList = $this->service->paginate();

        return view('admin.third_party.index', compact('thirdPartyList'));
    }

    public function create()
    {
        return view('admin.third_party.create', $this->formData());
    }

    public function store(StoreThirdPartyRequest $request)
    {
        $this->service->createThirdParty($request->validated());

        return redirect()
            ->route('admin.third-party.index')
            ->with('success', 'Third party created successfully.');
    }

    public function edit(ThirdParty $thirdParty)
    {
        $states = State::where('country_id', $thirdParty->country)->get();
        $cities = City::where('state_id', $thirdParty->state)->get();

        return view('admin.third_party.edit', array_merge(
            $this->formData(),
            compact('thirdParty', 'states', 'cities')
        ));
    }

    public function update(UpdateThirdPartyRequest $request, ThirdParty $thirdParty)
    {
        $this->service->updateThirdParty($thirdParty, $request->validated());

        return redirect()
            ->route('admin.third-party.index')
            ->with('success', 'Third party updated successfully.');
    }

    public function destroy(ThirdParty $thirdParty)
    {
        $this->service->deleteThirdParty($thirdParty);

        return redirect()
            ->route('admin.third-party.index')
            ->with('success', 'Third party deleted successfully.');
    }

    public function getStates($countryId)
    {
        return response()->json(State::where('country_id', $countryId)->get());
    }

    public function getCities($stateId)
    {
        return response()->json(City::where('state_id', $stateId)->get());
    }

    private function formData(): array
    {
        $selectedCountry = request()->old('country');
        $selectedState = request()->old('state');

        return [
            'thirdPartyTypes' => ThirdPartyType::where('status', 'open')->orderBy('type')->get(),
            'thirdPartyIsOptions' => ThirdPartyIs::where('status', 'open')->orderBy('name')->get(),
            'workForces' => WorkForce::where('status', 'open')->orderBy('id')->get(),
            'businessEntityTypes' => BusinessEntityType::where('status', 'open')->orderBy('label')->get(),
            'countries' => Country::orderBy('name')->get(),
            'states' => $selectedCountry ? State::where('country_id', $selectedCountry)->get() : collect(),
            'cities' => $selectedState ? City::where('state_id', $selectedState)->get() : collect(),
        ];
    }
}
