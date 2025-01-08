@extends('Admin.layout.Admintemp', ['title' => 'Tampil Data Produk'])
@section('judul')
    Data produk
@endsection
@section('content')
    <div class="card">

        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div>
                    <a href="/Produk/create" class="btn btn-primary btn-sm">Tambah Data Produk</a>
                </div>
                <div class="container mt-5">

                    @if (session('pesan'))
                        <div class="alert alert-success">
                            {{ session('pesan') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- <div class="card"> --}}
                    <h5 class="card-header">Tampil Data Produk</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Ukuran</th>
                                    <th>Jumlah Stok</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $kiw)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kiw->nama }}</td>
                                        <td>{{ $kiw->ukuran }}</td>
                                        <td>{{ $kiw->jumlah_stok }}</td>
                                        <td>{{ $kiw->harga }}</td>
                                        <td>{{ $kiw->diskon }}</td>
                                        <td>{{ $kiw->kategori->nama_kategori }}</td>
                                        <td>
                                            <a href="{{ route('Produk.edit', ['Produk' => $kiw->id]) }}"
                                                class="btn btn-success">Edit</a>

                                            {{-- <a href="/Produk/{{ $kiw->id }}" class="btn btn-success">Detail</a> --}}
                                            <form action="{{ route('Produk.destroy', $kiw->id) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $produk->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
