<?php

namespace App\Repositories\Contracts;

use App\Models\ThirdParty;

interface ThirdPartyRepositoryInterface
{
    public function paginate(int $perPage = 10);

    public function create(array $data): ThirdParty;

    public function find(int $id): ThirdParty;

    public function update(ThirdParty $thirdParty, array $data): ThirdParty;

    public function delete(ThirdParty $thirdParty): bool;
}
