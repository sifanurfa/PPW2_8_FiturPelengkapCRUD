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

        <h2 class="text-center mt-3">Daftar Buku</h2>

        <form action="{{ route('buku.search') }}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control my-3 mx-3" placeholder="Cari ...." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float:right;">
        </form>
        @if (Auth::check() && Auth::user()->level == 'admin')
        <a href="{{ route('buku.create') }}" class="btn btn-primary float-end my-3">Tambah Buku</a>
        @endif
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
                        <td>
                            @if ($buku->filepath)
                                <div class="relative h-10 w-10">
                                    <img src="{{ asset($buku->filepath) }}" alt="" class="h-full w-full rounded-full object-cover object-center">
                                </div>
                            @endif
                            {{ $buku->judul }}
                        </td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

        <p>Total Harga Buku: {{ "Rp. " . number_format($total_harga, 2, ',', '.') }}</p></body>
    </div>
@endsection
