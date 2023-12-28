<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsAktivitas extends Model
{
    use HasFactory;
    protected $table = 'mhs_aktivitas';
    protected $fillable = [
        'user_id',
        'id_aktivitas',
        'id_kategori',
        'tahun',
        'sertifikat',
        'foto',
        'url_penyelenggara'
    ];

    public function mahasiswa() 
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }

    public function kegiatan() 
    {
        return $this->belongsTo(listKegiatan::class, 'id_aktivitas');
    }

    public function kategori() 
    {
        return $this->belongsTo(listKategori::class, 'id_kategori');
    }
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
}
