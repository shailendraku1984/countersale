<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Services\Contracts\ExpenseServiceInterface;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    protected ExpenseServiceInterface $service;

    public function __construct(ExpenseServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'search',
            'head',
            'department',
            'bank_account',
            'date_from',
            'date_to',
        ]);

        $expenses = $this->service->paginate($filters);
        $formData = $this->service->formData();

        return view('admin.expenses.index', array_merge(
            compact('expenses', 'filters'),
            $formData
        ));
    }

    public function create()
    {
        return view('admin.expenses.create', $this->service->formData());
    }

    public function store(StoreExpenseRequest $request)
    {
        $this->service->createExpense($request->validated());

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('admin.expenses.edit', array_merge(
            $this->service->formData(),
            compact('expense')
        ));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $this->service->updateExpense($expense, $request->validated());

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $this->service->deleteExpense($expense);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
