<?php

use Illuminate\Database\Seeder;
use App\Users;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
            'name' => 'Wahyu',
            'username' => 'admin',
            'password' => Hash::make('admin')
        ]);
    }
}
