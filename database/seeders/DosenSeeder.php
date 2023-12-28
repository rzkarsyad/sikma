<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
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
                'user_id' => '1',
                'nidn' => '2102039',
                'nama' => 'Ahmad Handoyo',
                'email' => 'ahmadhandoyo@gmail.com',
                'institusi' => 'Universitas Al-Irsyad Cilacap',
                'id_prodi' => 1,
                'jns_kelamin' => 'P',
                'jabatan' => 'Dosen',
                'no_hp' => '08967099775',
            ],
        ];

        Dosen::insert($data);
    }
}
