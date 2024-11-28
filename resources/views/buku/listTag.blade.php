@extends('layouts.layout')

@section('title')
    <title>Review Buku</title>
@endsection

@section('content')
<div class="container py-3 mt-3 px-5">
    <h1>Daftar Tags</h1>

    @if ($tags->isEmpty())
        <p>Tidak ada tag yang tersedia.</p>
    @else
        <ul>
            @foreach ($tags as $tag)
            <a href="{{ route('reviews.byTag', $tag) }}" class="btn btn-outline-warning">{{ ucfirst($tag) }}</a>
            @endforeach
        </ul>
    @endif
    <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
</div>
@endsection
