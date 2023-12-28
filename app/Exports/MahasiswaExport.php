<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromQuery, WithMapping, WithHeadings
{
    private $rowNumber = 1;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Mahasiswa::query()->orderBy('nama', 'asc');
    }

    public function map($mahasiswa): array{

        $jenisKelamin = $mahasiswa->jns_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        return [
            $this->rowNumber++,
            $mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->institusi,
            $mahasiswa->prodi->jenjang->nama,
            $mahasiswa->prodi->fakultas->nama,
            $mahasiswa->prodi->nama,
            $mahasiswa->jalur->nama,
            $jenisKelamin,
            $mahasiswa->tempat_lahir,
            $mahasiswa->tgl_lahir,
            $mahasiswa->no_hp,
            $mahasiswa->email_kampus,
            $mahasiswa->alamat,
            $mahasiswa->tahun_masuk,
            $mahasiswa->nama_ortu,
            $mahasiswa->hubungan_ortu,
            $mahasiswa->no_hp_ortu,

        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'NIM',
            'Nama Lengkap',
            'Institusi',
            'Jenjang',
            'Fakultas',
            'Program Studi',
            'Jalur Masuk',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No. HP',
            'Email Kampus',
            'Alamat',
            'Tahun Masuk',
            'Nama Orang Tua',
            'Hubungan Orang Tua',
            'No. HP Orang Tua',
        ];
    }
}
