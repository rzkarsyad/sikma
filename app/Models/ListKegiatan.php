<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKegiatan extends Model
{
    use HasFactory;
    protected $table = 'list_kegiatan';
    protected $fillable = ['id','nama'];
}