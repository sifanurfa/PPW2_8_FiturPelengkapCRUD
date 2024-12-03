<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Buku;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function addToFavourite(Request $request, $id)
    {
        $book = Buku::findOrFail($id);
        $user = $request->user();

        if (!$user->favouriteBooks()->where('book_id', $id)->exists()) {
            $user->favouriteBooks()->attach($id);
            return back()->with('success', 'Book added to your favourites!');
        }

        return back()->with('info', 'This book is already in your favourites.');
    }

    public function myFavourites(Request $request)
    {
        $favourites = $request->user()->favouriteBooks()->select('judul', 'penulis')->get();

        return view('buku.favorit', compact('favourites'));
    }
}

