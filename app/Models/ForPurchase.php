<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ForPurchase extends Model
{
    protected $table = 'forPurchase';

    protected $fillable = [
        'title',
        'status',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
