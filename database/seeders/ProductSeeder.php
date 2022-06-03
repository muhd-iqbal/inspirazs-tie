<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            ['name' => "Tali Leher", 'slug' => "tali-leher", 'featured' => 1,],
            ['name' => "Tudung", 'slug' => "tudung", 'featured' => 1,],
        ]);
        DB::table('products')->insert([
            [
                'name' => "Tali Leher Korporat",
                'price' => 3600,
                'active' => 1,
                'category_id' => 1,
                'picture' => "images/icons/logo-01.png",
                'slug' => "tali-leher-korporat",
                'size' => "7cm, 8cm, 9cm"
            ],
            [
                'name' => "Tudung Sutera",
                'price' => 9500,
                'active' => 1,
                'category_id' => 2,
                'picture' => "images/icons/logo-02.png",
                'slug' => "tudung-sutera",
                'size' => "110cm X 110cm"
            ]
        ]);
        DB::table('product_prices')->insert([
            ['product_id' => 1, 'min' => 50, 'max' => 99, 'loan' => 4000, 'cash' => 3600],
            ['product_id' => 1, 'min' => 100, 'max' => 199, 'loan' => 2600, 'cash' => 2100],
            ['product_id' => 1, 'min' => 200, 'max' => 400, 'loan' => 2000, 'cash' => 1600],
            ['product_id' => 1, 'min' => 500, 'max' => 999, 'loan' => 1800, 'cash' => 1300],
            ['product_id' => 2, 'min' => 100, 'max' => 149, 'loan' => 10000, 'cash' => 9500],
            ['product_id' => 2, 'min' => 149, 'max' => 199, 'loan' => 9000, 'cash' => 8500],
            ['product_id' => 2, 'min' => 200, 'max' => 299, 'loan' => 8400, 'cash' => 7900],
            ['product_id' => 2, 'min' => 300, 'max' => 499, 'loan' => 7900, 'cash' => 7400],
            ['product_id' => 2, 'min' => 500, 'max' => 999, 'loan' => 76000, 'cash' => 7200],
            ['product_id' => 2, 'min' => 1000, 'max' => 9999, 'loan' => 7300, 'cash' => 6900],
        ]);
        DB::table('variables')->insert(
            ['name' => 'company_name', 'description' => 'Inspirazs Sdn. Bhd.']
        );
    }
}
