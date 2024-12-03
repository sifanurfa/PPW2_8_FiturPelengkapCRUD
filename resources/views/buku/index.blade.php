@extends('auth.layouts')

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

        <a href="{{ route('books.myfavourites') }}" class="btn btn-primary float-end my-3 me-3">Buku Favoritku</a>
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
                    <th colspan="3">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. " . number_format($buku->harga, 0, ',', '.') }}</td>
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
                        <td>
                            {{-- <form action="{{ route('buku.update', $buku->id) }}" method="POST"> --}}
                                <a href="{{ route('books.detail', $buku->id) }}" class="btn btn-primary">Detail</a>
                            {{-- </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

        <p>Total Harga Buku: {{ "Rp. " . number_format($total_harga, 2, ',', '.') }}</p></body>
    </div>
@endsection
