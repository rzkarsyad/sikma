<?php

namespace Database\Seeders;

use App\Models\ListAgenda;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListAgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
        [
            ['nama' => 'Bimbingan Konseling'],
            ['nama' => 'Bimbingan Pembina Ormawa'],
        ];

        ListAgenda::insert($data);
    }
}
