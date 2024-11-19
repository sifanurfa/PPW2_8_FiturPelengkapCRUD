<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index() {
        $books = Buku::latest()->paginate(5);

        return new BookResource(true, 'List Data Buku', $books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);

        $book = Buku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $book
        ], 201);        
    }
}
