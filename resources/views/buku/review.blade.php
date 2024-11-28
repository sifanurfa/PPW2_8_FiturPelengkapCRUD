@extends('layouts.layout')

@section('title')
    <title>Formulir Review Buku</title>
@endsection

@section('content')
<div class="container m-5">
    <h1 class="mb-4">Formulir Review Buku</h1>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="post">
        @csrf

        <!-- Dropdown -->
        <div class="mb-3">
            <label for="book_id" class="form-label">Pilih Buku</label>
            <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror">
                <option value="" disabled selected>Pilih buku untuk direview</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }}</option>
                @endforeach
            </select>
            @error('book_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Textarea untuk Review -->
        <div class="mb-3">
            <label for="review" class="form-label">Tulis Review</label>
            <textarea name="review" id="review" rows="5" class="form-control @error('review') is-invalid @enderror" placeholder="Tulis review Anda di sini..."></textarea>
            @error('review')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Multiple Inputs untuk Tag -->
        <div class="mb-3">
            <label for="tags" class="form-label">Tag</label>
            <input type="text" name="tags[]" class="form-control mb-2 @error('tags.*') is-invalid @enderror" placeholder="Masukkan tag pertama">
            <input type="text" name="tags[]" class="form-control mb-2" placeholder="Masukkan tag kedua">
            <input type="text" name="tags[]" class="form-control mb-2" placeholder="Masukkan tag ketiga">
            @error('tags.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Simpan Review</button>
        <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
    </form>

</div>
@endsection
