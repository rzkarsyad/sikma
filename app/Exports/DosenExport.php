<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DosenExport implements FromQuery, WithMapping, WithHeadings
{

    private $rowNumber = 1;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Dosen::query()->orderBy('nama', 'asc');
    }

    public function map($dosen): array{
        
        $jenisKelamin = $dosen->jns_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        return [
            $this->rowNumber++,
            $dosen->nidn,
            $dosen->nama,
            $dosen->email,
            $dosen->institusi,
            $dosen->prodi->nama,
            $jenisKelamin,
            $dosen->jabatan,
            $dosen->no_hp,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'NIDN',
            'Nama Lengkap',
            'Email',
            'Institusi',
            'Program Studi',
            'Jenis Kelamin',
            'Jabatan',
            'No. HP',
        ];
    }
}
