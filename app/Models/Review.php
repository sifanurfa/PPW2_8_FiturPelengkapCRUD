<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['book_id', 'reviewer_id', 'review', 'tags'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function book()
    {
        return $this->belongsTo(Buku::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
