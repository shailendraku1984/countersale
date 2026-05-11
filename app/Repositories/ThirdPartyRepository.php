<?php

namespace App\Repositories;

use App\Models\ThirdParty;
use App\Repositories\Contracts\ThirdPartyRepositoryInterface;

class ThirdPartyRepository implements ThirdPartyRepositoryInterface
{
    public function paginate(int $perPage = 10)
    {
        return ThirdParty::with([
            'typeData',
            'countryData',
            'stateData',
            'cityData',
            'thirdPartyIsData',
            'workForceData',
            'businessEntityTypeData',
        ])->latest()->paginate($perPage);
    }

    public function create(array $data): ThirdParty
    {
        return ThirdParty::create($data);
    }

    public function find(int $id): ThirdParty
    {
        return ThirdParty::findOrFail($id);
    }

    public function update(ThirdParty $thirdParty, array $data): ThirdParty
    {
        unset($data['vendor_code'], $data['customer_code']);

        $thirdParty->update($data);

        return $thirdParty;
    }

    public function delete(ThirdParty $thirdParty): bool
    {
        return $thirdParty->delete();
    }
}
