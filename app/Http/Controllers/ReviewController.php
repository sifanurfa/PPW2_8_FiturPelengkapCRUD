<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create()
    {
        $books = Buku::all();
        return view('buku.review', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'review' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
        ]);

        Review::create([
            'book_id' => $request->book_id,
            'reviewer_id' => Auth::id(),
            'review' => $request->review,
            'tags' => $request->tags,
        ]);

        return redirect()->route('buku.index')->with('review', 'Review berhasil disimpan!');
    }

    public function listReviewers()
    {
        $reviewers = User::where('level', 'internal_reviewer')->get();

        return view('buku.listReviewers', compact('reviewers'));
    }

    public function byReviewer($id)
    {
        $reviewer = User::findOrFail($id);
        $reviews = Review::where('reviewer_id', $id)->with('book')->get();
        return view('buku.byReviewer', compact('reviewer', 'reviews'));
    }

    public function listTags()
    {
        $tags = Review::all()->flatMap(function ($review) {
            return $review->tags;
        })->unique();

        return view('buku.listTag', compact('tags'));
    }

    public function byTag($tag)
    {
        $reviews = Review::whereJsonContains('tags', $tag)->with('book')->get();
        return view('buku.byTag', compact('reviews', 'tag'));
    }
}
