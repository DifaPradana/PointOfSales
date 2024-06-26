@include('reseller-partials.header')

<body id="page-top">

    <!-- Custom fonts for this template -->

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('reseller-partials.sidebar')
        @include('sweetalert::alert')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('reseller-partials.topbar')

                <!-- Begin Page Content -->

                <!-- Page Heading -->
                <h1 class="h3 mb-4 m-3 text-gray-800">Data {{ $title }}</h1>
                <div class="card shadow mb-4 m-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables {{ $title }}</h6>
                    </div>
                    <div class="card-body">
                        <br>
                        @if ($transaksi->isEmpty())
                            <p>No items in the cart.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Total Bayar</th>
                                            <th>Ekspedisi</th>
                                            <th>Status</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi as $transaksi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaksi->updated_at }}</td>
                                                <td>Rp.
                                                    {{ number_format($transaksi->total_bayar + $transaksi->harga_ongkir, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $transaksi->ekspedisi }}</td>
                                                <td>
                                                    @if ($transaksi->status === 'Menunggu Pembayaran')
                                                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                    @elseif($transaksi->status === 'Menunggu Verifikasi')
                                                        <span class="badge badge-info">Menunggu Verifikasi</span>
                                                    @elseif($transaksi->status === 'Pesanan Diproses')
                                                        <span class="badge badge-primary">Pesanan Diproses</span>
                                                    @elseif($transaksi->status === 'Pesanan Dibatalkan')
                                                        <span class="badge badge-danger">Pesanan Dibatalkan</span>
                                                    @elseif($transaksi->status === 'Pesanan Dikirim')
                                                        <span class="badge badge-info">Pesanan Dikirim</span>
                                                    @elseif($transaksi->status === 'Diterima')
                                                        <span class="badge badge-success">Diterima</span>
                                                    @else
                                                        <span class="badge badge-secondary">Status Tidak Dikenal</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($transaksi->status === 'Menunggu Pembayaran')
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#editModal{{ $transaksi->kode_transaksi }}"
                                                            class="btn btn-info block btn-sm">
                                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                                        </button>
                                                        <br>
                                                        <form action="" method="POST" style="margin-top: 10px;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger block btn-sm">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>

                                                        <div class="modal fade"
                                                            id="editModal{{ $transaksi->kode_transaksi }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">
                                                                            Upload
                                                                            Bukti Pembayaran
                                                                        </h5>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('reseller.pembelian.store', $transaksi->kode_transaksi) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="bukti_bayar">Upload Foto
                                                                                    Bukti:</label>
                                                                                <input type="file" id="bukti_bayar"
                                                                                    name="bukti_bayar" accept="image/*"
                                                                                    required>
                                                                                <img id="gambar-preview" src="#"
                                                                                    alt="Preview Gambar"
                                                                                    style="display: none; max-width: 400px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($transaksi->status === 'Pesanan Dikirim')
                                                        <form
                                                            action="{{ route('reseller.pembelian.update', $transaksi->kode_transaksi) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary block btn-sm">
                                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            {{-- <h3>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }} </h3> --}}
                            <br>

                        @endif
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('reseller-partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('reseller-partials.logout')

    @include('reseller-partials.script')
    <script>
        document.getElementById('bukti_bayar').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('gambar-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>

</body>

</html>
