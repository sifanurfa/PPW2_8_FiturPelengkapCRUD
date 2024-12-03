@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Buku Favoritku</h1>
    @if($favourites->isEmpty())
        <p>Belum ada buku favorit.</p>
    @else
        <ul class="list-group">
            @foreach($favourites as $book)
                <li class="list-group-item">
                    <strong>{{ $book->title }}</strong> oleh {{ $book->author }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
