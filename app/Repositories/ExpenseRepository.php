<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return Expense::with([
            'headData',
            'departmentData',
            'bankAccountData',
        ])
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('label', 'like', '%'.$search.'%')
                        ->orWhere('account', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
                });
            })
            ->when($filters['head'] ?? null, fn ($query, string $head) => $query->where('head', $head))
            ->when($filters['department'] ?? null, fn ($query, string $department) => $query->where('department', $department))
            ->when($filters['bank_account'] ?? null, fn ($query, string $bankAccount) => $query->where('bank_account', $bankAccount))
            ->when($filters['date_from'] ?? null, fn ($query, string $dateFrom) => $query->whereDate('value_date', '>=', $dateFrom))
            ->when($filters['date_to'] ?? null, fn ($query, string $dateTo) => $query->whereDate('value_date', '<=', $dateTo))
            ->latest('value_date')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data): Expense
    {
        return Expense::create($data);
    }

    public function update(Expense $expense, array $data): Expense
    {
        $expense->update($data);

        return $expense;
    }

    public function delete(Expense $expense): bool
    {
        return $expense->delete();
    }
}
