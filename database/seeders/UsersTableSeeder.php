<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Amr',
            'email' => 'amr@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            //'remember_token' => Str::random(10),
        ]);
    }
}
