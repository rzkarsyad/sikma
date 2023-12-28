<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Prodi;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\JalurMasuk;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        $bulanIndonesia = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        foreach ($rows as $row) {
            
            $existingMahasiswa = Mahasiswa::where('nim', $row['nim'])
                                  ->orWhere('email', $row['email'])
                                  ->first();
        
            if (!$existingMahasiswa) {
            
                $existingUser = User::where('nim_nidn', $row['nim'])
                                    ->orWhere('email', $row['email'])
                                    ->first();
        
                if (!$existingUser) {
            
                    $user = User::create([
                        'nim_nidn' => $row['nim'],
                        'email' => $row['email'],
                        'password' => Hash::make($row['nim']),
                        'type' => 0,
                    ]);
        
                    $prodi = Prodi::where('nama', $row['program_studi'])->first();
                    $jalur = JalurMasuk::where('nama', $row['jalur_masuk'])->first();
        
                    $jns_kelamin = $row['jenis_kelamin'] === 'Pria' ? 'P' : 'W';

                    $excelDate = $row['tanggal_lahir'];

                    $dateParts = explode(' ', $excelDate);
                    $day = $dateParts[0];
                    $month = $bulanIndonesia[$dateParts[1]];
                    $year = $dateParts[2];
                
                    $tgl_lahir = "$year-$month-$day";


                    Mahasiswa::create([
                        'nim' => $row['nim'],
                        'user_id' => $user->id,
                        'nama' => $row['nama_lengkap'],
                        'institusi' => $row['institusi'],
                        'id_prodi' => $prodi ? $prodi->id : null,
                        'id_jalur' => $jalur ? $jalur->id : null,
                        'jns_kelamin' => $jns_kelamin,
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tgl_lahir' => $tgl_lahir,
                        'nik' => $row['nik'],
                        'no_hp' => $row['no_hp'],
                        'email' => $row['email'],
                        'alamat' => $row['alamat'],
                        'nama_ortu' => $row['nama_orang_tua'],
                        'hubungan_ortu' => $row['hubungan_orang_tua'],
                        'no_hp_ortu' => $row['no_hp_orang_tua'],
                        'tahun_masuk' => $row['tahun_masuk'],
                    ]);
        
                    Session::flash('success', 'Data mahasiswa berhasil diimport.');
                } else {
                    Session::flash('error', 'Data mahasiswa sudah ada');
                }
            } else {
                Session::flash('error', 'Data mahasiswa sudah ada');
            }
        }
    }

}
