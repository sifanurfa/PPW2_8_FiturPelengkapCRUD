<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    
    public function index()
    {
        $data_buku = Buku::all()->sortByDesc('id');
        $total_buku = Buku::count();
        $total_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'total_buku', 'total_harga'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.update', compact('buku'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);

        $buku = Buku::find($id);
        
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('success', 'Buku berhasil diupdate!');
    }
}
