<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book = Buku::findOrFail($bookId);

        // Cek apakah user sudah memberikan rating
        $existingRating = Rating::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this book.');
        }

        // Simpan rating
        Rating::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }

    public function show($bookId)
    {
        $book = Buku::with('ratings')->findOrFail($bookId);

        // Hitung rata-rata rating
        $ratings = $book->ratings;
        if ($ratings->isEmpty()) {
            $averageRating = null;
        } else {
            $averageRating = $ratings->avg('rating');
        }

        return view('buku.detail', compact('book', 'averageRating'));
    }
}
