<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
    protected $table = 'head_head';

    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }
}
