<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            $existingDosen = Dosen::where('nidn', $row['nidn'])
                                  ->orWhere('email', $row['email'])
                                  ->first();
        
            if (!$existingDosen) {
            
                $existingUser = User::where('nim_nidn', $row['nidn'])
                                    ->orWhere('email', $row['email'])
                                    ->first();
        
                if (!$existingUser) {
            
                    $user = User::create([
                        'nim_nidn' => $row['nidn'],
                        'email' => $row['email'],
                        'password' => Hash::make($row['nidn']),
                        'type' => 1,
                    ]);
        
                    $prodi = Prodi::where('nama', $row['program_studi'])->first();
        
                    $jns_kelamin = $row['jenis_kelamin'] === 'Pria' ? 'P' : 'W';
        
                    Dosen::create([
                        'nidn' => $row['nidn'],
                        'user_id' => $user->id,
                        'nama' => $row['nama_lengkap'],
                        'email' => $row['email'],
                        'institusi' => $row['institusi'],
                        'id_prodi' => $prodi ? $prodi->id : null,
                        'jns_kelamin' => $jns_kelamin,
                        'jabatan' => $row['jabatan'],
                        'no_hp' => $row['no_hp'],
                    ]);
        
                    Session::flash('success', 'Data dosen berhasil diimport.');
                } else {
                    Session::flash('error', 'Data dosen sudah ada');
                }
            } else {
                Session::flash('error', 'Data dosen sudah ada');
            }
        }
        
    }
}
