<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jibon',
            'email' => 'jibon@gmail.com',
            'password' => bcrypt('password'),
            'avater' => 'me.jpg',
        ]);

        User::create([
            'name' => 'Sobuj',
            'email' => 'sobuj@gmail.com',
            'password' => bcrypt('password'),
            'avater' => 'me.jpg',
        ]);

        foreach(range(1, 15) as $i){
            User::factory()->create();
        }
    }
}
