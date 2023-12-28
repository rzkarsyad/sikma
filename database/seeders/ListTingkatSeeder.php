<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListTingkat;

class ListTingkatSeeder extends Seeder
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
            ['nama' => 'Tingkat Kabupaten'],
            ['nama' => 'Tingkat Provinsi'],
            ['nama' => 'Tingkat Nasional'],
            ['nama' => 'Tingkat Internasional'],
        ];

        ListTingkat::insert($data);
    }
}
