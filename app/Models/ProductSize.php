<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_size';

    protected $fillable = [
        'code',
        'title',
        'status',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
