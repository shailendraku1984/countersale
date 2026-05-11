<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkForce extends Model
{
    protected $table = 'workforce';

    protected $fillable = [
        'label',
        'status',
    ];
}
