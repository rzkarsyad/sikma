<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsPrestasi extends Model
{
    use HasFactory;
    protected $table = 'mhs_prestasi';
    protected $fillable = [
        'user_id',
        'id_kegiatan',
        'nama',
        'penyelenggara',
        'jumlah',
        'capaian',
        'tanggal_mulai',
        'tanggal_selesai',
        'tropi',
        'url_penyelenggara',
        'foto',
        'undangan',
    ];

    public function tingkat() 
    {
        return $this->belongsTo(listTingkat::class, 'id_kegiatan');
    }
}
