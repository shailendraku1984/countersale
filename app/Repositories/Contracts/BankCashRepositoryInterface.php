<?php

namespace App\Repositories\Contracts;

use App\Models\BankCash;

interface BankCashRepositoryInterface
{
    public function paginate(int $perPage = 10);

    public function create(array $data): BankCash;

    public function find(int $id): BankCash;

    public function update(BankCash $bankCash, array $data): BankCash;

    public function delete(BankCash $bankCash): bool;
}
