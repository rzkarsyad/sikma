<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListOrmawa;

class ListOrmawaSeeder extends Seeder
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
            ['nama' => 'BEM Universitas'],
            ['nama' => 'BEM Fakultas'],
            ['nama' => 'UKM'],
            ['nama' => 'HIMA'],
        ];

        ListOrmawa::insert($data);
    }
}
