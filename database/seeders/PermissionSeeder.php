<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'dashboard.view',
                'module' => 'dashboard',
            ],

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'users.view',
                'module' => 'users',
            ],

            [
                'name' => 'users.create',
                'module' => 'users',
            ],

            [
                'name' => 'users.edit',
                'module' => 'users',
            ],

            [
                'name' => 'users.delete',
                'module' => 'users',
            ],

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'roles.manage',
                'module' => 'roles',
            ],

            /*
            |--------------------------------------------------------------------------
            | Warehouse
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'warehouse.view',
                'module' => 'warehouse',
            ],

            [
                'name' => 'warehouse.create',
                'module' => 'warehouse',
            ],

            [
                'name' => 'warehouse.edit',
                'module' => 'warehouse',
            ],

            [
                'name' => 'warehouse.delete',
                'module' => 'warehouse',
            ],

            /*
            |--------------------------------------------------------------------------
            | CMS
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'cms.view',
                'module' => 'cms',
            ],

            [
                'name' => 'cms.create',
                'module' => 'cms',
            ],

            [
                'name' => 'cms.edit',
                'module' => 'cms',
            ],

            [
                'name' => 'cms.delete',
                'module' => 'cms',
            ],

            /*
            |--------------------------------------------------------------------------
            | Bank Cash
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'bank-cash.view',
                'module' => 'bank-cash',
            ],

            [
                'name' => 'bank-cash.create',
                'module' => 'bank-cash',
            ],

            [
                'name' => 'bank-cash.edit',
                'module' => 'bank-cash',
            ],

            [
                'name' => 'bank-cash.delete',
                'module' => 'bank-cash',
            ],

            /*
            |--------------------------------------------------------------------------
            | Third Party
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'third-party.view',
                'module' => 'third-party',
            ],

            [
                'name' => 'third-party.create',
                'module' => 'third-party',
            ],

            [
                'name' => 'third-party.edit',
                'module' => 'third-party',
            ],

            [
                'name' => 'third-party.delete',
                'module' => 'third-party',
            ],

            /*
            |--------------------------------------------------------------------------
            | Products
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'products.view',
                'module' => 'products',
            ],

            [
                'name' => 'products.create',
                'module' => 'products',
            ],

            [
                'name' => 'products.edit',
                'module' => 'products',
            ],

            [
                'name' => 'products.delete',
                'module' => 'products',
            ],

            /*
            |--------------------------------------------------------------------------
            | Expenses
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'expenses.view',
                'module' => 'expenses',
            ],

            [
                'name' => 'expenses.create',
                'module' => 'expenses',
            ],

            [
                'name' => 'expenses.edit',
                'module' => 'expenses',
            ],

            [
                'name' => 'expenses.delete',
                'module' => 'expenses',
            ],

        ];

        foreach ($permissions as $permission) {

            DB::table('permissions')->updateOrInsert(

                [
                    'name' => $permission['name'],
                ],

                [
                    'module' => $permission['module'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
