<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'product_color';

    protected $fillable = [
        'name',
        'color_code',
        'status',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
