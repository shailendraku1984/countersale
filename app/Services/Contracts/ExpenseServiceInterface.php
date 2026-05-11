<?php

namespace App\Services\Contracts;

use App\Models\Expense;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ExpenseServiceInterface
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator;

    public function formData(): array;

    public function createExpense(array $data): Expense;

    public function updateExpense(Expense $expense, array $data): Expense;

    public function deleteExpense(Expense $expense): bool;
}
