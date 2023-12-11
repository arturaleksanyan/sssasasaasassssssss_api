<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  

        \App\Models\User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => env('ADMIN_USERNAME'),
            'password'=> env('ADMIN_PASSWORD'),
        ]);
    }
}
  