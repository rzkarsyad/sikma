<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'email',
        'institusi',
        'id_prodi',
        'jns_kelamin',
        'jabatan',
        'no_hp',
    ];

    public function prodi() 
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }
}
