@extends('layouts.layout')

@section('title')
    <title>Books</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Daftar Buku</h2>
        <a href="{{ route('buku.create') }}" class="btn btn-primary float-end my-3">Tambah Buku</a>
        <table class="table table-stripped">
            <thead class="text-center">
                <tr class="table-primary">
                    <th>id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <p>Total Buku: {{ $total_buku }}</p>
        <p>Total Harga Buku: {{ "Rp. " . number_format($total_harga, 2, ',', '.') }}</p></body>    
    </div>
@endsection