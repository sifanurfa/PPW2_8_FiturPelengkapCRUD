@extends('layouts.layout')

@section('title')
    <title>Review Buku</title>
@endsection

@section('content')
<div class="container py-3 mt-3 px-5">
    <h1>Daftar Reviewer</h1>

    @if ($reviewers->isEmpty())
        <p>Tidak ada reviewer ditemukan.</p>
    @else
        <ul>
            @foreach ($reviewers as $reviewer)
            <a href="{{ route('reviews.byReviewer', $reviewer->id) }}" class="btn btn-outline-warning">{{ $reviewer->name }}</a>
            @endforeach
        </ul>
    @endif

    <a href="{{ '/buku' }}" class="btn btn-danger">Kembali</a>
</div>
@endsection
