@extends('layouts.layout')

@section('title')
    <title>Edit Buku</title>
@endsection

@section('content')
    <div class="container bg-dark-subtle py-3 mt-3 px-5">
        <h4 class="mt-3 mb-3">Edit Buku</h4>

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="date form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}">
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="{{ $buku->discount }}" min="0" max="100">
            </div>
    {{-- <div class="form-group">
        <label for="discount">Diskon (%)</label>
        <input type="number" name="discount" id="discount" class="form-control"
               value="{{ old('discount', $book->discount) }}" min="0" max="100">
    </div> --}}

            <div class="mb-3">
                <label for="editorial_pick">Editorial Pick</label>
                <input type="checkbox" name="editorial_pick" id="editorial_pick" value="1" {{ old('editorial_pick', $book->editorial_pick ?? false) ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
        </form>
    </div>
@endsection
