<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $fillable = [
        'id',
        'id_jenjang',
        'id_fakultas',
        'nama',
    ];

    public function jenjang() 
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang', 'id');
    }

    public function fakultas() 
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }
}

