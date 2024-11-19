<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit'];
    protected $dates = ['tgl_terbit'];
}
