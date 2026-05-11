<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessEntityType extends Model
{
    protected $table = 'business_entity';

    protected $fillable = [
        'label',
        'status',
    ];
}
