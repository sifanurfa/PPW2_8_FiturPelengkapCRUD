<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $dates = ['tgl_terbit'];
    protected $fillable = ['judul', 'penulis', 'harga', 'editorial_pick'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount > 0) {
            return $this->harga - ($this->harga * $this->discount / 100);
        }
        return $this->harga;
    }
}
