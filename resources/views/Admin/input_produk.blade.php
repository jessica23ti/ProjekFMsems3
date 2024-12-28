@extends('Admin.layout.Admintemp', ['title' => 'Input Produk'])
@section('content')
    <!-- Content -->
    <!-- Form controls -->
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Input Produk</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('Produk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="nama"
                                value="{{ old('nama') }}" />
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="deskripsi"
                                value="{{ old('deskripsi') }}" />
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
                            </select>
                        </div>


                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Ukuran </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="ukuran"
                                value="{{ old('ukuran') }}" />
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Stock </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="jumlah_stok"
                                value="{{ old('jumlah_stok') }}" />
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Harga </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="harga"
                                value="{{ old('harga') }}" />
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="exampleFormControlInput1" class="form-label">Diskon </label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="diskon"
                                value="{{ old('diskon') }}" />
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="productImages" class="form-label">Upload Gambar Produk</label>
                            <input type="file" name="images[]" id="productImages" class="form-control" multiple>
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
