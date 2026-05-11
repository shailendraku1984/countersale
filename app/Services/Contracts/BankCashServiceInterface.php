<?php

namespace App\Services\Contracts;

use App\Models\BankCash;

interface BankCashServiceInterface
{
    public function paginate(int $perPage = 10);

    public function createBankCash(array $data): BankCash;

    public function findBankCash(int $id): BankCash;

    public function updateBankCash(BankCash $bankCash, array $data): BankCash;

    public function deleteBankCash(BankCash $bankCash): bool;
}
