<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOrmawa extends Model
{
    use HasFactory;
    protected $table = 'list_ormawa';
    protected $fillable = ['id','nama'];
}
