<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Country
        |--------------------------------------------------------------------------
        */

        $india = Country::create([
            'name' => 'India',
            'code' => 'IN',
        ]);

        /*
        |--------------------------------------------------------------------------
        | States
        |--------------------------------------------------------------------------
        */

        $delhi = State::create([
            'country_id' => $india->id,
            'name' => 'Delhi',
        ]);

        $maharashtra = State::create([
            'country_id' => $india->id,
            'name' => 'Maharashtra',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        City::create([
            'state_id' => $delhi->id,
            'name' => 'New Delhi',
        ]);

        City::create([
            'state_id' => $delhi->id,
            'name' => 'Dwarka',
        ]);

        City::create([
            'state_id' => $maharashtra->id,
            'name' => 'Mumbai',
        ]);

        City::create([
            'state_id' => $maharashtra->id,
            'name' => 'Pune',
        ]);
    }
}