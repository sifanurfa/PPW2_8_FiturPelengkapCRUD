@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>{{ $book->judul }}</h1>
    <p>Author: {{ $book->penulis }}</p>

    <h3>Average Rating:
        @if($averageRating)
            {{ number_format($averageRating, 2) }}
        @else
            Rating is not available
        @endif
    </h3>

    @auth
    <form action="{{ route('books.rate', $book->id) }}" method="POST">
        @csrf
        <label for="rating">Rate this book (1-5):</label>
        <select name="rating" id="rating" required>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class="btn btn-primary">Submit Rating</button>
    </form>
    @endauth

    @guest
    <p>Please <a href="{{ route('login') }}">log in</a> to rate this book.</p>
    @endguest

    <form action="{{ route('books.favourite', $book->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Simpan ke daftar favorit</button>
    </form>

</div>
@endsection
