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
        'agenda_date',
        'agenda_time',
        'nidn',
        'title',
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
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
}
