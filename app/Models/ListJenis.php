<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListJenis extends Model
{
    use HasFactory;
    protected $table = 'list_jenis';
    protected $fillable = ['id','nama'];
}
