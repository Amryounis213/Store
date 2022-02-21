<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_encode(["categories.view-any", "categories.view", "categories.create", "categories.update", "categories.delete", "roles.view-any", "roles.view", "roles.create", "roles.update", "roles.delete", "products.view-any", "products.view", "products.create", "products.update", "products.delete"]);
        DB::table('roles')->insert([
            'name' => 'super_admin2',
            'abilities' => $data,
        ]);
    }
}
