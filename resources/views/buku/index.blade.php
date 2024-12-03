@extends('auth.layouts')

@section('style')
<style>
    .original-price {
    text-decoration: line-through;
    color: grey;
}
.discounted-price {
    font-weight: bold;
    color: green;
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @endif
        </div>

        @if(Session::has('pesan'))
            <div class="alert alert-success">{{ Session::get('pesan') }}</div>
        @endif
        @if(Session::has('pesanHapus'))
            <div class="alert alert-success">{{ Session::get('pesanHapus') }}</div>
        @endif
        @if(Session::has('pesanEdit'))
            <div class="alert alert-success">{{ Session::get('pesanEdit') }}</div>
        @endif
        @if(Session::has('review'))
            <div class="alert alert-success">{{ Session::get('review') }}</div>
        @endif

        <h2 class="text-center mt-3">Daftar Buku</h2>

        <h2>Editorial Picks</h2>
        <div class="container">
            <div class="row">
                @foreach ($editorial_picks as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <strong>{{ $book->judul }}</strong>
                                <p>By {{ $book->penulis }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <form action="{{ route('buku.search') }}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control my-3 mx-3" placeholder="Cari ...." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float:right;">
        </form>

        @if (Auth::check() && Auth::user()->level == 'admin')
        <a href="{{ route('buku.create') }}" class="btn btn-primary float-end my-3">Tambah Buku</a>
        @endif
        @if (Auth::check() && (Auth::user()->level == 'admin' || Auth::user()->level == 'internal_reviewer'))
        <a href="{{ route('reviews.create') }}" class="btn btn-warning float-end my-3 me-3">Review Buku</a>
        @endif

        <a href="{{ route('reviews.listTags') }}" class="btn btn-success float-end my-3 me-3">Review by Tag</a>
        <a href="{{ route('reviews.listReviewers') }}" class="btn btn-info float-end my-3 me-3">Review by Reviewer</a>

        <table class="table table-stripped">
            <thead class="text-center">
                <tr class="table-primary">
                    <th>id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <th colspan="2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        {{-- <td>{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }}</td> --}}
                        <td class="text-center">
                            @if ($buku->discount > 0)
                                <span style="text-decoration: line-through; color: red;">{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }} </span>
                                <span style="background-color: green; color: white; margin: 3px; border-radius: 3px; padding: 2px;">{{ $buku->discount . "% off" }}</span>
                                <span style="color: green;">{{ "Rp. " . number_format($buku->discounted_price, 0, ',', '.') }} </span>
                            @else
                                <span>{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }} </span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->Format('d/m/Y') }}</td>
                        @if (Auth::check() && Auth::user()->level == 'admin')
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Edit</a>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

        <p>Total Harga Buku: {{ "Rp. " . number_format($total_harga, 2, ',', '.') }}</p></body>
    </div>
@endsection
