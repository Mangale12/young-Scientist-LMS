<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('Softech@123'),
           
        ]);
        User::create([
            'name' => 'User One',
            'email' => 'user@gmail.com',
            'password' => bcrypt('Softech@123'),
            
        ]);
    }
}