<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\listKegiatan;

class ListKegiatanSeeder extends Seeder
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
            ['nama' => 'POMARU'],
            ['nama' => 'Pelatihan Softskill Kijisube'],
            ['nama' => 'Halaqoh Asrama'],
            ['nama' => 'Halaqoh Non Asrama'],
            ['nama' => 'Program Kreativitas Mahasiswa (PKM)'],
            ['nama' => 'Penerimaan Tamu Racana (PTR)'],
            ['nama' => 'Pelatihan Dasar Kepemimpinan'],
        ];

        listKegiatan::insert($data);
    }
}
