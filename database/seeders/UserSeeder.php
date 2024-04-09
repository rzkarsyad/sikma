<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nim_nidn'=>'admin',
                'email'=>'admin@gmail.com',
                'type'=> 2,
                'password'=> bcrypt('admin'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
