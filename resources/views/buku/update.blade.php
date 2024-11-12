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

        <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
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
            {{-- <div class="mb-3">
                <label for="thumbnail" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            </div> --}}

            <div class="col-span-full mt-6">
                <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                <div class="mt-2">
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
            </div>
            <div class="col-span-full mt-5">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">
                </div>
                <button class="btn btn-primary">
                    <a id="tambah" onclick="addFileInput()">Tambah Input data</a>
                </button>

                <script type="text/javascript">
                    function addFileInput() {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            <div class="gallery_items">
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item">
                        <img src="{{ asset($gallery->path) }}" alt="" class="rounded-full object-cover object-center" width="400">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
        </form>
    </div>
@endsection
