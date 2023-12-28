<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
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
            ['nama' => 'Fakultas Ilmu Sosial'],
            ['nama' => 'Fakultas Farmasi, Sains dan Teknologi'],
            ['nama' => 'Fakultas Ilmu Kesehatan'],
        ];

        Fakultas::insert($data);
    }
}
