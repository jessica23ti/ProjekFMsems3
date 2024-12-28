@extends('Admin.layout.Admintemp', ['title' => 'Edit Produk'])
@section('content')
    <!-- Content -->
    <!-- Form controls -->
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Edit Data Produk : <b>{{ strtoupper($produk->nama) }}</b> <b></b></h5>
            <div class="form-group mt-1 mb-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="form-group mt-1 mb-3">
                @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Produk.update', $produk->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 align-items-center">
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="exampleFormControlInput1" name="nama" value="{{ old('nama') ?? $produk->nama }}" />
                            <span class="text-danger">
                                {{ $errors->first('nama') }}
                            </span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                id="exampleFormControlInput1" name="deskripsi"
                                value="{{ old('deskripsi') ?? $produk->deskripsi }}" />
                            <span class="text-danger">
                                {{ $errors->first('deskripsi') }}
                            </span>
                        </div>

                        <div class="col-6 col-sm-4">
                            <label for="categorySelect" class="form-label">Kategori</label>
                            <select class="form-select" id="categorySelect" name="kategori_id"
                                aria-label="Default select example">
                                <option value="">Pilih Kategori</option>
                                <!-- value="" untuk default yang tidak dipilih -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                                <span class="text-danger">
                                    {{ $errors->first('kategori_id') }}
                                </span>
                            </select>
                        </div>


                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Ukuran</label>
                            <input type="text" class="form-control @error('ukuran') is-invalid @enderror"
                                id="exampleFormControlInput1" name="ukuran"
                                value="{{ old('ukuran') ?? $produk->ukuran }}" />
                            <span class="text-danger">
                                {{ $errors->first('ukuran') }}
                            </span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Stock </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="jumlah_stok"
                                value="{{ old('jumlah_stok') ?? $produk->jumlah_stok }}" />
                            <span class="text-danger">
                                {{ $errors->first('jumlah_stok') }}
                            </span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Harga </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="harga"
                                value="{{ old('harga') ?? $produk->harga }}" />
                            <span class="text-danger">
                                {{ $errors->first('harga') }}
                            </span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Diskon </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="diskon"
                                value="{{ old('diskon') ?? $produk->diskon }}" />
                            <span class="text-danger">
                                {{ $errors->first('diskon') }}
                            </span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="productImages" class="form-label">Upload Gambar Produk</label>
                            <input type="file" name="images[]" id="productImages" class="form-control" multiple>
                            <span class="text-danger">
                                {{ $errors->first('images[]') }}
                            </span>
                        </div>
                    </div>
                    <br><br>
                    <button class="btn rounded-pill btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 Script -->
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}", // Gunakan tanda kutip agar aman
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
