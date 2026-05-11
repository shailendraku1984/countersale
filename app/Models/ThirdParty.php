<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThirdParty extends Model
{
    use SoftDeletes;

    protected $table = 'third_party';

    protected $fillable = [
        'third_party_name',
        'third_party_type',
        'branch_name',
        'vendor_code',
        'customer_code',
        'vendor',
        'status',
        'country',
        'state',
        'city',
        'baecode',
        'address',
        'zipcode',
        'phone',
        'web_url',
        'sales_tax',
        'vat_id',
        'third_party_is',
        'work_force',
        'business_entity_type',
        'capital',
        'logo',
    ];

    public function typeData()
    {
        return $this->belongsTo(ThirdPartyType::class, 'third_party_type');
    }

    public function countryData()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function stateData()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function cityData()
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function thirdPartyIsData()
    {
        return $this->belongsTo(ThirdPartyIs::class, 'third_party_is');
    }

    public function workForceData()
    {
        return $this->belongsTo(WorkForce::class, 'work_force');
    }

    public function businessEntityTypeData()
    {
        return $this->belongsTo(BusinessEntityType::class, 'business_entity_type');
    }
}
