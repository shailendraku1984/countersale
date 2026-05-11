<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdPartyIs extends Model
{
    protected $table = 'third_party_is';

    protected $fillable = [
        'name',
        'status',
    ];
}
