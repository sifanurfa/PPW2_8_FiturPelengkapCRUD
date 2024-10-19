@extends('layouts.layout')

@section('title')
    <title>Tambah Buku</title>
@endsection

@section('content')
    <div class="container bg-dark-subtle py-3 mt-3 px-5">
        <h4 class="mt-3 mb-3">Tambah Buku</h4>

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ route('buku.store') }}">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="date form-control" id="tgl_terbit" name="tgl_terbit" placeholder="yyyy/mm/dd">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
        </form>
    </div>
@endsection
