<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papernote extends Model
{
    use HasFactory;
    protected $table = 'papernotes';
    protected $fillable = [
        'judul',
        'gambar',
        'isi',
    ];
}
