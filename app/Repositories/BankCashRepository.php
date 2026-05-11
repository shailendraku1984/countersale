<?php

namespace App\Repositories;

use App\Models\BankCash;
use App\Repositories\Contracts\BankCashRepositoryInterface;

class BankCashRepository implements BankCashRepositoryInterface
{
    public function paginate(int $perPage = 10)
    {
        return BankCash::with([
            'accountType',
            'currencyData',
            'countryData',
            'stateData',
            'cityData',
        ])->latest()->paginate($perPage);
    }

    public function create(array $data): BankCash
    {
        return BankCash::create($data);
    }

    public function find(int $id): BankCash
    {
        return BankCash::findOrFail($id);
    }

    public function update(BankCash $bankCash, array $data): BankCash
    {
        $bankCash->update($data);

        return $bankCash;
    }

    public function delete(BankCash $bankCash): bool
    {
        return $bankCash->delete();
    }
}
