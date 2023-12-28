<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JalurMasuk;

class JalurMasukSeeder extends Seeder
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
            ['nama' => 'Transfer'],
            ['nama' => 'Beasiswa Tahfidz'],
            ['nama' => 'Beasiswa Yatim Piatu'],
            ['nama' => 'Reguler - PJJ'],
            ['nama' => 'Reguler'],
            ['nama' => 'KIP UNAIC'],
        ];

        JalurMasuk::insert($data);
    }
}
