<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsAgenda extends Model
{
    use HasFactory;
    protected $table = 'mhs_agenda';
    protected $fillable = [
        'user_id',
        'type',
        'agenda_date',
        'agenda_time',
        'dosen_id',
        'topic',
        'content',
        'result',
        'action',
        'status',
    ];
    
    public function mahasiswa() 
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }
    
    public function dosen() 
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'nidn');
    }

    public function prodi() 
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }
}
