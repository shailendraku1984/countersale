<?php

namespace App\Repositories\Contracts;

use App\Models\Expense;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ExpenseRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Expense;

    public function update(Expense $expense, array $data): Expense;

    public function delete(Expense $expense): bool;
}
