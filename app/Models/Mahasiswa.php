<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'institusi',
        'id_prodi',
        'id_jalur',
        'jns_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'nik',
        'no_hp',
        'email',
        'alamat',
        'nama_ortu',
        'hubungan_ortu',
        'no_hp_ortu',
        'tahun_masuk',
    ];

    public function jalur()
    {
        return $this->belongsTo(JalurMasuk::class, 'id_jalur', 'id');
    }

    public function prodi() 
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }

    public function fakultas() 
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }

    public function jenjang() 
    {
        return $this->belongsTo(Jenjang::class, 'jenjang', 'id');
    }

    public function agenda()
    {
        return $this->hasMany(MhsAgenda::class, 'user_id', 'user_id');
    }

    public function aktivitas()
    {
        return $this->hasMany(MhsAktivitas::class, 'user_id', 'user_id');
    }

    public function kegiatan()
    {
        return $this->hasMany(MhsKegiatan::class, 'user_id', 'user_id');
    }

    public function prestasi()
    {
        return $this->hasMany(MhsPrestasi::class, 'user_id', 'user_id');
    }

    public function ormawa()
    {
        return $this->hasMany(MhsOrmawa::class, 'user_id', 'user_id');
    }

}
