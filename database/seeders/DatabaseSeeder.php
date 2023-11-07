<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin Pertama',
            'email' => 'admin_1@example.com',
            'password' => '123qweasd',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'User Pertama',
            'email' => 'user_1@example.com',
            'password' => '123qweasd',
        ]);

        DB::table('users')->insert([
            'name' => 'User Kedua',
            'email' => 'user_2@example.com',
            'password' => '123qweasd',
        ]);
    }
}
