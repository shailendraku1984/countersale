<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $table = 'expense';

    protected $fillable = [
        'label',
        'value_date',
        'head',
        'department',
        'description',
        'bank_account',
        'account',
        'image',
    ];

    protected $casts = [
        'value_date' => 'date',
    ];

    public function headData()
    {
        return $this->belongsTo(ExpenseHead::class, 'head');
    }

    public function departmentData()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function bankAccountData()
    {
        return $this->belongsTo(BankCash::class, 'bank_account');
    }
}
