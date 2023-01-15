<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $categories = [
            [
                'category_name' => 'Electronic'
            ],
            [
                'category_name' => 'Food'
            ],
            [
                'category_name' => 'Fashion'
            ],
            [
                'category_name' => 'Accesory'
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
