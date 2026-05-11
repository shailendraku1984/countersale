<?php

namespace App\Services;

use App\Models\BankCash;
use App\Repositories\Contracts\BankCashRepositoryInterface;
use App\Services\Contracts\BankCashServiceInterface;

class BankCashService implements BankCashServiceInterface
{
    protected BankCashRepositoryInterface $repository;

    public function __construct(BankCashRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginate(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function createBankCash(array $data): BankCash
    {
        return $this->repository->create($data);
    }

    public function findBankCash(int $id): BankCash
    {
        return $this->repository->find($id);
    }

    public function updateBankCash(BankCash $bankCash, array $data): BankCash
    {
        return $this->repository->update($bankCash, $data);
    }

    public function deleteBankCash(BankCash $bankCash): bool
    {
        return $this->repository->delete($bankCash);
    }
}
