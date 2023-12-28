<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
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
            [
                'id_jenjang' => '3',
                'id_fakultas' => '1',
                'nama' => 'Bisnis Digital'
            ],
            [
                'id_jenjang' => '3',
                'id_fakultas' => '1',
                'nama' => 'Kewirausahaan'
            ],
            [
                'id_jenjang' => '3',
                'id_fakultas' => '2',
                'nama' => 'Farmasi'
            ],
            [
                'id_jenjang' => '1',
                'id_fakultas' => '2',
                'nama' => 'Farmasi D3'
            ],
            [
                'id_jenjang' => '2',
                'id_fakultas' => '2',
                'nama' => 'Teknologi Laboratorium Medis'
            ],
            [
                'id_jenjang' => '1',
                'id_fakultas' => '3',
                'nama' => 'Keperawatan'
            ],
            [
                'id_jenjang' => '1',
                'id_fakultas' => '3',
                'nama' => 'Kebidanan'
            ],
            [
                'id_jenjang' => '1',
                'id_fakultas' => '3',
                'nama' => 'Fisioterapi'
            ],
            [
                'id_jenjang' => '3',
                'id_fakultas' => '3',
                'nama' => 'Ilmu Keperawatan'
            ],
            [
                'id_jenjang' => '3',
                'id_fakultas' => '3',
                'nama' => 'Kebidanan'
            ],
            [
                'id_jenjang' => '4',
                'id_fakultas' => '3',
                'nama' => 'Profesi Ners'
            ],
            [
                'id_jenjang' => '4',
                'id_fakultas' => '3',
                'nama' => 'Pendidikan Profesi Bidan'
            ],
        ];

        Prodi::insert($data);
    }
}
