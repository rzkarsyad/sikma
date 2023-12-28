<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\listKategori;

class ListKategoriSeeder extends Seeder
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
            ['nama' => 'Tingkat Universitas'],
            ['nama' => 'Tingkat Fakultas'],
            ['nama' => 'Tingkat Prodi'],
        ];

        listKategori::insert($data);
    }
}
