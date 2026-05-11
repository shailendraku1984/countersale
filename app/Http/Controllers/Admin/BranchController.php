<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Branch;
use App\Models\Country;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

use App\Services\Contracts\BranchServiceInterface;

class BranchController extends Controller
{
    protected BranchServiceInterface $service;

    public function __construct(BranchServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $branches = $this->service->paginate();
        return view('admin.branch.index',compact('branches')
        );
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.branch.create',compact('countries'));
    }

    public function store(StoreBranchRequest $request) {
        $this->service->createBranch($request->validated());
        return redirect()->route('admin.branch.index')->with('success','Branch created successfully.');
    }

    public function edit(Branch $branch) {
        $countries = Country::all();
        $states = State::where('country_id',$branch->country_id)->get();
        $cities = City::where('state_id',$branch->state_id)->get();

        return view('admin.branch.edit',compact('branch','countries','states','cities'));
    }

    public function update(UpdateBranchRequest $request,Branch $branch) {
        $this->service->updateBranch($branch,$request->validated());
        return redirect()->route('admin.branch.index')->with('success','Branch updated successfully.');
    }

    public function destroy(Branch $branch) {
        $this->service->deleteBranch($branch);
        return redirect()->route('admin.branch.index')->with('success','Branch deleted successfully.');
    }

    public function getStates($countryId) {
        return response()->json(State::where('country_id',$countryId)->get());
    }

    public function getCities($stateId) {
        return response()->json(City::where('state_id',$stateId)->get());
    }
}