<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ForSale extends Model
{
    protected $table = 'forSale';

    protected $fillable = [
        'title',
        'status',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
