<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAgenda extends Model
{
    use HasFactory;
    protected $table = 'list_agenda';
    protected $fillable = ['id','nama'];
}
