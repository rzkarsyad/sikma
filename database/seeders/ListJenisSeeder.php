<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListJenis;

class ListJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        [
            ['nama' => 'Peserta'],
            ['nama' => 'Panitia'],
            ['nama' => 'Pembicara/Pemateri'],
        ];

        ListJenis::insert($data);
    }
}
