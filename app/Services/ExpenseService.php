<?php

namespace App\Services;

use App\Models\BankCash;
use App\Models\Department;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Services\Contracts\ExpenseServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ExpenseService implements ExpenseServiceInterface
{
    protected ExpenseRepositoryInterface $repository;

    public function __construct(ExpenseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($filters, $perPage);
    }

    public function formData(): array
    {
        return [
            'heads' => ExpenseHead::open()->orderBy('name')->get(),
            'departments' => Department::open()->orderBy('name')->get(),
            'bankAccounts' => BankCash::orderBy('bank_or_cash_label')->get(),
        ];
    }

    public function createExpense(array $data): Expense
    {
        return DB::transaction(function () use ($data) {
            $data = $this->storeWebpImage($data);

            return $this->repository->create($data);
        });
    }

    public function updateExpense(Expense $expense, array $data): Expense
    {
        return DB::transaction(function () use ($expense, $data) {
            $data = $this->storeWebpImage($data, $expense);

            return $this->repository->update($expense, $data);
        });
    }

    public function deleteExpense(Expense $expense): bool
    {
        return DB::transaction(fn () => $this->repository->delete($expense));
    }

    private function storeWebpImage(array $data, ?Expense $expense = null): array
    {
        if (! (($data['image'] ?? null) instanceof UploadedFile)) {
            unset($data['image']);

            return $data;
        }

        $image = $data['image'];
        $contents = file_get_contents($image->getRealPath());

        if ($contents === false) {
            throw new RuntimeException('Unable to read uploaded expense image.');
        }

        if (! function_exists('imagecreatefromstring') || ! function_exists('imagewebp')) {
            throw new RuntimeException('The PHP GD extension is required to convert expense images to webp.');
        }

        $resource = imagecreatefromstring($contents);

        if ($resource === false) {
            throw new RuntimeException('Unable to process uploaded expense image.');
        }

        imagepalettetotruecolor($resource);
        imagealphablending($resource, true);
        imagesavealpha($resource, true);

        ob_start();
        $converted = imagewebp($resource, null, 85);
        $webpContents = ob_get_clean();
        imagedestroy($resource);

        if (! $converted || ! $webpContents) {
            throw new RuntimeException('Unable to convert expense image to webp.');
        }

        if ($expense?->image) {
            Storage::disk('public')->delete($expense->image);
        }

        $path = 'expenses/'.Str::uuid().'.webp';
        Storage::disk('public')->put($path, $webpContents);
        $data['image'] = $path;

        return $data;
    }
}
