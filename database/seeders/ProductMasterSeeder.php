<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductMasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ($this->colors() as $color) {
            DB::table('product_color')->updateOrInsert(
                ['name' => $color['name']],
                [
                    'color_code' => $color['color_code'],
                    'status' => 'open',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        foreach ($this->sizes() as $size) {
            DB::table('product_size')->updateOrInsert(
                ['code' => $size['code']],
                [
                    'title' => $size['title'],
                    'status' => 'open',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        foreach (['For sale', 'Not for sale'] as $title) {
            DB::table('forSale')->updateOrInsert(
                ['title' => $title],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['For purchase', 'Not for purchase'] as $title) {
            DB::table('forPurchase')->updateOrInsert(
                ['title' => $title],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['0%', '5%', '7%', '18%'] as $label) {
            DB::table('tax_rate')->updateOrInsert(
                ['label' => $label],
                ['status' => 'open', 'created_at' => $now, 'updated_at' => $now]
            );
        }
    }

    private function colors(): array
    {
        return [
            ['name' => 'Red', 'color_code' => '#ff0000'],
            ['name' => 'Green', 'color_code' => '#008000'],
            ['name' => 'Blue', 'color_code' => '#0000ff'],
            ['name' => 'Yellow', 'color_code' => '#ffff00'],
            ['name' => 'White', 'color_code' => '#ffffff'],
            ['name' => 'Black', 'color_code' => '#000000'],
        ];
    }

    private function sizes(): array
    {
        return [
            ['code' => 'XS', 'title' => 'Extra small'],
            ['code' => 'S', 'title' => 'Small'],
            ['code' => 'M', 'title' => 'Medium'],
            ['code' => 'L', 'title' => 'Large'],
            ['code' => 'XL', 'title' => 'Extra large'],
        ];
    }
}
