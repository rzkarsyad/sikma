<?php

namespace App\Models;

use App\Models\ListAgenda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MhsAgenda extends Model
{
    use HasFactory;
    protected $table = 'mhs_agenda';
    protected $fillable = [
        'user_id',
        'id_agenda',
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

    public function type()
    {
        return $this->belongsTo(ListAgenda::class, 'id_agenda');
    }
}
