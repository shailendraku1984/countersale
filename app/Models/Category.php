<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name',
        'parent_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Parent Category
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Child Categories
    |--------------------------------------------------------------------------
    */

    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
}