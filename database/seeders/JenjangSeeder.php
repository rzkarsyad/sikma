<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jenjang;

class JenjangSeeder extends Seeder
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
            ['nama' => 'D3 - Diploma 3'],
            ['nama' => 'D4 - Diploma 4'],
            ['nama' => 'S1 - Sarjana'],
            ['nama' => 'Prof - Profesi'],
        ];

        Jenjang::insert($data);
    }
}
