<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThirdPartyLookupSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach (['prospect', 'customer', 'prospect_customer', 'no_prospect_no_customer'] as $type) {
            DB::table('vendor_type')->updateOrInsert(
                ['type' => $type],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['government company', 'Laege company', 'Medium company', 'Other', 'Private individual', 'small company'] as $name) {
            DB::table('third_party_is')->updateOrInsert(
                ['name' => $name],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['1-5', '6-10', '11-50', '51-100', '100-500', '>500'] as $label) {
            DB::table('workforce')->updateOrInsert(
                ['label' => $label],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['Sole proprietorships', 'Partnerships', 'Corporations', 'S Corporations', 'Limited Liability company(LLP)', 'Other'] as $label) {
            DB::table('business_entity')->updateOrInsert(
                ['label' => $label],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }
    }
}
