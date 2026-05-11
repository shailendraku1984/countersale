<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankCashRequest;
use App\Http\Requests\UpdateBankCashRequest;
use App\Models\BankAccountType;
use App\Models\BankCash;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\State;
use App\Services\Contracts\BankCashServiceInterface;

class BankCashController extends Controller
{
    protected BankCashServiceInterface $service;

    public function __construct(BankCashServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $bankCashList = $this->service->paginate();

        return view('admin.bank_cash.index', compact('bankCashList'));
    }

    public function create()
    {
        return view('admin.bank_cash.create', $this->formData());
    }

    public function store(StoreBankCashRequest $request)
    {
        $this->service->createBankCash($request->validated());

        return redirect()
            ->route('admin.bank-cash.index')
            ->with('success', 'Bank cash created successfully.');
    }

    public function edit(BankCash $bankCash)
    {
        $states = State::where('country_id', $bankCash->country)->get();
        $cities = City::where('state_id', $bankCash->state)->get();

        return view('admin.bank_cash.edit', array_merge(
            $this->formData(),
            compact('bankCash', 'states', 'cities')
        ));
    }

    public function update(UpdateBankCashRequest $request, BankCash $bankCash)
    {
        $this->service->updateBankCash($bankCash, $request->validated());

        return redirect()
            ->route('admin.bank-cash.index')
            ->with('success', 'Bank cash updated successfully.');
    }

    public function destroy(BankCash $bankCash)
    {
        $this->service->deleteBankCash($bankCash);

        return redirect()
            ->route('admin.bank-cash.index')
            ->with('success', 'Bank cash deleted successfully.');
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
        return [
            'accountTypes' => BankAccountType::orderBy('label')->get(),
            'currencies' => Currency::orderBy('label')->get(),
            'countries' => Country::orderBy('name')->get(),
        ];
    }
}
