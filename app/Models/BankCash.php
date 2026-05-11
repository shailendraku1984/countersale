<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankCash extends Model
{
    use SoftDeletes;

    protected $table = 'bank_cash';

    protected $fillable = [
        'ref',
        'bank_or_cash_label',
        'account_type',
        'currency',
        'status',
        'country',
        'state',
        'city',
        'minimum_allowed_balance',
        'minimum_desired_balance',
        'bank_name',
        'account_number',
        'IBAN_account_number',
        'SWIFT_code',
        'bank_address',
        'account_owner_name',
        'account_owner_address',
        'accounting_account',
    ];

    public function accountType()
    {
        return $this->belongsTo(BankAccountType::class, 'account_type');
    }

    public function currencyData()
    {
        return $this->belongsTo(Currency::class, 'currency');
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
}
