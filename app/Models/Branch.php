<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'branch_name',
        'address',
        'zipcode',
        'country_id',
        'state_id',
        'city_id',

    ];

    public function country()
    {
        return $this->belongsTo(
            Country::class
        );
    }

    public function state()
    {
        return $this->belongsTo(
            State::class
        );
    }

    public function city()
    {
        return $this->belongsTo(
            City::class
        );
    }
}