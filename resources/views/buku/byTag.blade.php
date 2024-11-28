@extends('layouts.layout')

@section('title')
    <title>Review Buku</title>
@endsection

@section('content')
<div class="container py-3 mt-3 px-5">
    <h1>Review Berdasarkan Tag: {{ ucfirst($tag) }}</h1>

    @if ($reviews->isEmpty())
        <p>Tidak ada review untuk tag ini.</p>
    @else
    <div class="container">
        <div class="row">
            @foreach ($reviews as $review)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <strong>{{ $review->book->judul }}</strong> - {{ $review->created_at->format('d M Y') }}
                            <p>{{ $review->review }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    <a href="{{ route('reviews.listReviewers') }}" class="btn btn-warning">Kembali</a>
    <a href="{{ '/buku' }}" class="btn btn-danger">Home</a>
</div>
@endsection
