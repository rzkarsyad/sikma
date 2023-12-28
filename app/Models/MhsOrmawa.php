<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsOrmawa extends Model
{
    use HasFactory;
    protected $table = 'mhs_ormawa';
    protected $fillable = [
        'user_id',
        'id_jenis_ormawa',
        'nama_ormawa',
        'jabatan',
        'masa_jabatan',
        'sk',
        'url_media_ormawa',
    ];

    public function ormawa() 
    {
        return $this->belongsTo(ListOrmawa::class, 'id_jenis_ormawa');
    }
}
