<?php

namespace App\Services;

use App\Models\ThirdParty;
use App\Repositories\Contracts\ThirdPartyRepositoryInterface;
use App\Services\Contracts\ThirdPartyServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ThirdPartyService implements ThirdPartyServiceInterface
{
    protected ThirdPartyRepositoryInterface $repository;

    public function __construct(ThirdPartyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginate(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function createThirdParty(array $data): ThirdParty
    {
        $data['vendor_code'] = $this->generateUniqueCode('vendor_code', 'VND');
        $data['customer_code'] = $this->generateUniqueCode('customer_code', 'CUS');
        $data = $this->storeLogo($data);

        return $this->repository->create($data);
    }

    public function findThirdParty(int $id): ThirdParty
    {
        return $this->repository->find($id);
    }

    public function updateThirdParty(ThirdParty $thirdParty, array $data): ThirdParty
    {
        $data = $this->storeLogo($data, $thirdParty);

        return $this->repository->update($thirdParty, $data);
    }

    public function deleteThirdParty(ThirdParty $thirdParty): bool
    {
        return $this->repository->delete($thirdParty);
    }

    private function generateUniqueCode(string $column, string $prefix): string
    {
        do {
            $code = $prefix.'-'.now()->format('Ymd').'-'.str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (ThirdParty::where($column, $code)->exists());

        return $code;
    }

    private function storeLogo(array $data, ?ThirdParty $thirdParty = null): array
    {
        if (($data['logo'] ?? null) instanceof UploadedFile) {
            if ($thirdParty?->logo) {
                Storage::disk('public')->delete($thirdParty->logo);
            }

            $data['logo'] = $data['logo']->store('third-party-logos', 'public');
        } else {
            unset($data['logo']);
        }

        return $data;
    }
}
