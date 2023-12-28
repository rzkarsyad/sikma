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
               'nim_nidn'=>'2102039',
               'email'=>'dosen@gmail.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
                'nim_nidn'=>'0',
                'email'=>'admin@gmail.com',
                'type'=> 2,
                'password'=> bcrypt('123456'),
            ],
            [
               'nim_nidn'=>'210202017',
               'email'=>'edu.rzkarsyad@gmail.com',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
