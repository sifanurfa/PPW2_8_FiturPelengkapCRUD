@extends('layouts.layout')

@section('title')
    <title>Tambah Buku</title>
@endsection

@section('content')
    <div class="container bg-dark-subtle py-3 mt-3 px-5">
        <h4 class="mt-3 mb-3">Tambah Buku</h4>
        <form method="post" action="{{ route('buku.store') }}">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga"required>
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ '/buku' }}">Kembali</a>
        </form>
    </div>
@endsection