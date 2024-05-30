@include('partials.header')

<body id="page-top">

    <!-- Custom fonts for this template -->

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.sidebar')
        @include('sweetalert::alert')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('partials.topbar')

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
                                                <td>{{ \Carbon\Carbon::parse($transaksi->updated_at)->format('d/m/Y') }}
                                                </td>
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
                                                    @elseif($transaksi->status === 'Pesanan Ditolak')
                                                        <span class="badge badge-danger">Pesanan Ditolak</span>
                                                    @elseif($transaksi->status === 'Pesanan Dikirim')
                                                        <span class="badge badge-success">Pesanan Ditolak</span>
                                                    @else
                                                        <span class="badge badge-secondary">Status Tidak Dikenal</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($transaksi->bukti_bayar)
                                                        <a href="{{ asset($transaksi->bukti_bayar) }}" target="_blank"
                                                            class="btn btn-info block btn-sm"
                                                            style="width: 40px; margin-bottom: 10px;">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-info block btn-sm"
                                                            style="width: 40px; " disabled>
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    @endif
                                                    <br>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#editModal{{ $transaksi->kode_transaksi }}"
                                                        style="width: 40px;" class="btn btn-primary block btn-sm">
                                                        <i class='fa fa-edit' aria-hidden="true"></i>
                                                    </button>

                                                    <form action="" method="POST" style="margin-top: 10px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger block btn-sm"
                                                            style="width: 40px;">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>

                                                    <div class="modal fade"
                                                        id="editModal{{ $transaksi->kode_transaksi }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit
                                                                        {{ $title }}
                                                                    </h5>

                                                                </div>
                                                                <form
                                                                    action="{{ route('admin.pesanan.update', $transaksi->kode_transaksi) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">

                                                                        <div class="form-group">
                                                                            <label for="status">Status</label>
                                                                            <select class="form-control" id="status"
                                                                                name="status">
                                                                                <option value="Menunggu Pembayaran"
                                                                                    {{ $transaksi->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>
                                                                                    Menunggu Pembayaran</option>
                                                                                <option value="Menunggu Verifikasi"
                                                                                    {{ $transaksi->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>
                                                                                    Menunggu Verifikasi</option>
                                                                                <option value="Pesanan Diproses"
                                                                                    {{ $transaksi->status == 'Pesanan Diproses' ? 'selected' : '' }}>
                                                                                    Pesanan Diproses</option>
                                                                            </select>
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

            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('partials.logout')

    @include('partials.script')
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
