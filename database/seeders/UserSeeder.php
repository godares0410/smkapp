<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Taufiqur Rahman, S.Kom',
            'username' => 'trahman',
            'password' => bcrypt('rahman111'),
            'level' => 1,
            'email' => 'test@example.com',
        ]);
    }
}
