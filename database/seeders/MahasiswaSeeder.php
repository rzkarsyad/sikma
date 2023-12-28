<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_id' => '3',
                'nim' => '210202017',
                'nama' => 'Muhammad Fauzan',
                'institusi' => 'Universitas Al-Irsyad Cilacap',
                'id_prodi' => 1,
                'id_jalur' => 1,
                'jns_kelamin' => 'P',
                'tempat_lahir' => 'Cilacap',
                'tgl_lahir' => '2003-08-16',
                'nik' => '330122230902',
                'no_hp' => '08967099775',
                'email' => 'mfauzan@unaic.ac.id',
                'alamat' => 'Jl. Dr. Radjiman No. 1 Cilacap',
                'nama_ortu' => 'Sutoyo',
                'hubungan_ortu' => 'Ayah',
                'no_hp_ortu' => '08926153121',
                'tahun_masuk' => '2021',
            ],
        ];

        Mahasiswa::insert($data);
    }
}
