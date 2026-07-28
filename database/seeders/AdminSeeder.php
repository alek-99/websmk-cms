<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Smk Maulana Hasanudin',
            'email' => 'admin@smkmaulanahasanudin.com',
            'password' => bcrypt('smkmaulana123'), // Change the password as needed
        ]);
    }
}
