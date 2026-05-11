<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseMasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ($this->heads() as $head) {
            DB::table('head_head')->updateOrInsert(
                ['name' => $head],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach ($this->departments() as $department) {
            DB::table('department')->updateOrInsert(
                ['name' => $department],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }
    }

    private function heads(): array
    {
        return [
            'Accured expenses',
            'Administrative expenses',
            'Advertising',
            'Bank changes',
            'Capital expenses',
            'Conveyance',
            'Depriciation',
            'Employee Perks',
            'Financial expenses',
            'Fixed expenses',
            'Home office',
            'Insurance',
            'Labour charges',
            'Non-operating Expenses',
            'Office expenses',
            'Operating expenses',
            'Refund local sales_tax',
            'Rent',
            'Staff welfare',
            'Taxes',
            'Training and learning',
            'Travel',
            'Utilities',
            'Variable expenses',
            'Wages',
        ];
    }

    private function departments(): array
    {
        return [
            'Hr',
            'Finance',
            'IT',
            'Manufacturing',
            'Others',
            'Procurement',
            'Sales',
            'Sales and marketing',
            'Supply chain',
        ];
    }
}
