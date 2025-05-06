<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jhon Doe',
            'email' => 'jhondoe@gmail.com',
            'password' => bcrypt('123'), // Use bcrypt for hashing the password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
