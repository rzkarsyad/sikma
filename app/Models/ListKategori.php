<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKategori extends Model
{
    use HasFactory;
    protected $table = 'list_kategori';

    protected $fillable = ['id','nama'];
}
