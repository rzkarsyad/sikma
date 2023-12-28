<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsKegiatan extends Model
{
    use HasFactory;
    protected $table = 'mhs_kegiatan';
    protected $fillable = [
        'user_id',
        'id_kegiatan',
        'id_jenis',
        'nama',
        'penyelenggara',
        'jumlah',
        'tanggal_mulai',
        'tanggal_selesai',
        'sertifikat',
        'foto',
        'undangan',
        'url_penyelenggara'
    ];

    public function mahasiswa() 
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }

    public function tingkat() 
    {
        return $this->belongsTo(ListTingkat::class, 'id_kegiatan');
    }

    public function jenis() 
    {
        return $this->belongsTo(ListJenis::class, 'id_jenis');
    }
}
