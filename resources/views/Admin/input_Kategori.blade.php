@extends('Admin.layout.Admintemp', ['title' => 'Input Produk'])
@section('judul')
    Input Kategori
@endsection
@section('content')
    <!-- Content -->
    <!-- Form controls -->
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Input Category Produk</h5>

            <form action="{{ route('Kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Nama Category</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_kategori" />
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="deskripsi" />
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label"> Thumbnail For Category</label>
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="gambar" />
                    </div>

                    <button class="btn rounded-pill btn-primary">Submit</button>
                </div>

            </form>
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
