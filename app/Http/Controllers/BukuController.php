<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku', 'total_harga'));
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('buku.search', compact('data_buku', 'no', 'jumlah_buku', 'cari'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uplouds', $fileName, 'public');

        Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240, 320)
            ->save();

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uplouds', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                ]);
            }
        }


        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->filename = $fileName;
        $buku->filepath = '/storage/'.$filePath;
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan!');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesanHapus', 'Data Buku Berhasil Dihapus!');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.update', compact('buku'));
    }

    public function update(Request $request, $id){
        $buku = Buku::find($id);

        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uplouds', $fileName, 'public');

        Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240, 320)
            ->save();

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uplouds', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);
            }
        }

        $buku->update([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'harga'     => $request->harga,
            'tgl_terbit'=> $request->tgl_terbit,
            'filename'  => $fileName,
            'filepath'  => '/storage/'.$filePath
        ]);

        $buku->save();

        return redirect('/buku')->with('pesanEdit', 'Data Buku Berhasil Diupdate!');
    }
}
