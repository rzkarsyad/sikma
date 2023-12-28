<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTingkat extends Model
{
    use HasFactory;
    protected $table = 'list_tingkat';
    protected $fillable = ['id','nama'];
}
