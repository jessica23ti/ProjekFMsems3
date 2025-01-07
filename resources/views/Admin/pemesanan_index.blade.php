@extends('Admin.layout.Admintemp', ['title' => 'Tampil Data Pemesanan'])
@section('judul')
    Data Pemesanan
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 mt-3">
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
                    <h4 class="card-header">Tampil Data Pemesanan</h4>
                    <div class="divButton">

                        <button class="btn btn-outline-primary" id="Print">Print</button>
                        <button class="btn btn-outline-danger" id="PDF">PDF</button>
                        <button class="btn btn-outline-success" id="Excel">Excel</button>
                        <button class="btn btn-outline-success" id="CSV">CSV</button>
                        <button class="btn btn-outline-info" id="Copy">Copy</button>
                    </div>


                    <div class="table-responsive text-nowrap">
                        <table id="table-datatables" class="display nowrap" style="width:100%">
                            <thead class="table-dark custome">
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Alamat</th>
                                    <th>Total Item <br> Pesanan</th>
                                    <th>Total Biaya</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanan as $kiw)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kiw->user->name }}</td>
                                        <td>{{ $kiw->shipping_address }}</td>
                                        <td>{{ $kiw->total_item_pesanan }}</td>
                                        <td>{{ $kiw->total_biaya }}</td>
                                        <td>{{ $kiw->updated_at }}</td>
                                        <td>{{ $kiw->status_pesan }}</td>
                                        <td></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {!! $pemesanan->links() !!}
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                // Simpan objek DataTable dalam variabel 'table'
                var table = new DataTable('#table-datatables', {
                    dom: 'Bfrtip', // Menampilkan buttons
                    buttons: [{
                            extend: 'excel',
                            init: function(api, node, config) {
                                $(node).hide();
                            }
                        },
                        {
                            extend: 'copy',
                            init: function(api, node, config) {
                                $(node).hide();
                            }
                        },
                        {
                            extend: 'csv',
                            init: function(api, node, config) {
                                $(node).hide();
                            }
                        },
                        {
                            extend: 'print',
                            init: function(api, node, config) {
                                $(node).hide();
                            }
                        },
                        {
                            extend: 'pdf',
                            init: function(api, node, config) {
                                $(node).hide();
                            }
                        }
                    ],
                    layout: {
                        topStart: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    }
                });

                // Menyambungkan tombol print dengan button DataTable
                $('#Print').on('click', function() {
                    // Menggunakan objek 'table' untuk memicu fungsi print
                    table.button('.buttons-print').trigger();
                });
                $('#PDF').on('click', function() {
                    // Menggunakan objek 'table' untuk memicu fungsi pdf
                    table.button('.buttons-pdf').trigger();
                });
                $('#CSV').on('click', function() {
                    // Menggunakan objek 'table' untuk memicu fungsi csv
                    table.button('.buttons-csv').trigger();
                });
                $('#Excel').on('click', function() {
                    // Menggunakan objek 'table' untuk memicu fungsi excel
                    table.button('.buttons-excel').trigger();
                });
                $('#Copy').on('click', function() {
                    // Menggunakan objek 'table' untuk memicu fungsi copy
                    table.button('.buttons-copy').trigger();
                });
            });
        </script>
    @endsection
