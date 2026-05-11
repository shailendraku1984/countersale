<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Category;
use App\Models\ForPurchase;
use App\Models\ForSale;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\TaxRate;
use App\Models\Warehouse;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ProductService implements ProductServiceInterface
{
    protected ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
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
            'categories' => Category::orderBy('category_name')->get(),
            'branches' => Branch::orderBy('branch_name')->get(),
            'warehouses' => Warehouse::orderBy('warehouse_name')->get(),
            'forSales' => ForSale::open()->orderBy('id')->get(),
            'forPurchases' => ForPurchase::open()->orderBy('id')->get(),
            'productColors' => ProductColor::open()->orderBy('name')->get(),
            'productSizes' => ProductSize::open()->orderBy('id')->get(),
            'taxRates' => TaxRate::open()->orderBy('id')->get(),
        ];
    }

    public function createProduct(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $data['slug'] = Str::slug($data['slug']);
            $data = $this->storeWebpImage($data);

            return $this->repository->create($data);
        });
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            $data['slug'] = Str::slug($data['slug']);
            $data = $this->storeWebpImage($data, $product);

            return $this->repository->update($product, $data);
        });
    }

    public function deleteProduct(Product $product): bool
    {
        return DB::transaction(fn () => $this->repository->delete($product));
    }

    private function storeWebpImage(array $data, ?Product $product = null): array
    {
        if (! (($data['image'] ?? null) instanceof UploadedFile)) {
            unset($data['image']);

            return $data;
        }

        $image = $data['image'];
        $contents = file_get_contents($image->getRealPath());

        if ($contents === false) {
            throw new RuntimeException('Unable to read uploaded product image.');
        }

        if (! function_exists('imagecreatefromstring') || ! function_exists('imagewebp')) {
            throw new RuntimeException('The PHP GD extension is required to convert product images to webp.');
        }

        $resource = imagecreatefromstring($contents);

        if ($resource === false) {
            throw new RuntimeException('Unable to process uploaded product image.');
        }

        imagepalettetotruecolor($resource);
        imagealphablending($resource, true);
        imagesavealpha($resource, true);

        ob_start();
        $converted = imagewebp($resource, null, 85);
        $webpContents = ob_get_clean();
        imagedestroy($resource);

        if (! $converted || ! $webpContents) {
            throw new RuntimeException('Unable to convert product image to webp.');
        }

        if ($product?->image) {
            Storage::disk('public')->delete($product->image);
        }

        $path = 'products/'.Str::uuid().'.webp';
        Storage::disk('public')->put($path, $webpContents);
        $data['image'] = $path;

        return $data;
    }
}
