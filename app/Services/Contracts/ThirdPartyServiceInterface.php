<?php

namespace App\Services\Contracts;

use App\Models\ThirdParty;

interface ThirdPartyServiceInterface
{
    public function paginate(int $perPage = 10);

    public function createThirdParty(array $data): ThirdParty;

    public function findThirdParty(int $id): ThirdParty;

    public function updateThirdParty(ThirdParty $thirdParty, array $data): ThirdParty;

    public function deleteThirdParty(ThirdParty $thirdParty): bool;
}
