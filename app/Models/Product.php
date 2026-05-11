<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
        'branch',
        'warehouse',
        'forSale',
        'forPurchase',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'stock',
        'tax_rate',
        'product_color',
        'product_size',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function branchData()
    {
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function warehouseData()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse');
    }

    public function forSaleData()
    {
        return $this->belongsTo(ForSale::class, 'forSale');
    }

    public function forPurchaseData()
    {
        return $this->belongsTo(ForPurchase::class, 'forPurchase');
    }

    public function productColorData()
    {
        return $this->belongsTo(ProductColor::class, 'product_color');
    }

    public function productSizeData()
    {
        return $this->belongsTo(ProductSize::class, 'product_size');
    }

    public function taxRateData()
    {
        return $this->belongsTo(TaxRate::class, 'tax_rate');
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
