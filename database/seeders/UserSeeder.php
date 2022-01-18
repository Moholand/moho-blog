<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin user
        User::create([
            'name' => 'ادمین',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'isAdmin' => true
        ]);

        \App\Models\User::factory(50)->create();
    }
}
