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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id');
    }
    public function favouritedBy()
{
    return $this->belongsToMany(User::class, 'favourite_books', 'book_id', 'user_id')->withTimestamps();
}

}
