<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdPartyType extends Model
{
    protected $table = 'vendor_type';

    protected $fillable = [
        'type',
        'status',
    ];
}
