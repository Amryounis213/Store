<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $status = ['Active', 'Draft'];

        $price = rand(800, 1000);
        $price_sale = $price - 45;
        $this->call([
            UsersTableSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}
