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
                        @if ($cart->isEmpty())
                            <p>No items in the cart.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Satuan</th>
                                            <th>Kuantitas</th>
                                            <th>Subtotal</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $cart)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cart->barang->nama_barang }}</td>
                                                <td>Rp. {{ number_format($cart->barang->harga_jual, 0, ',', '.') }}</td>
                                                <td>{{ $cart->kuantitas }}</td>
                                                <td>Rp. {{ number_format($cart->subtotal, 0, ',', '.') }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('reseller.cart-update', $cart->no_detail) }}"
                                                        class="btn btn-primary btn-icon-split btn-sm">
                                                        <span class="text">Edit</span>
                                                    </a> --}}
                                                    <button type="button" class="btn btn-primary flex-fill mx-1"
                                                        data-toggle="modal"
                                                        data-target="#editModal{{ $cart->no_detail }}">
                                                        Edit
                                                    </button>
                                                    <form id="deleteForm{{ $cart->no_detail }}"
                                                        action="{{ route('reseller.cart-delete', $cart->no_detail) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-icon-split btn-sm"
                                                            onclick="confirmDelete({{ $cart->no_detail }})">
                                                            <span class="text">Hapus</span>
                                                        </button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(id) {
                                                            Swal.fire({
                                                                title: "Are you sure?",
                                                                text: "You won't be able to revert this!",
                                                                icon: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: "#3085d6",
                                                                cancelButtonColor: "#d33",
                                                                confirmButtonText: "Yes, delete it!"
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Get the form element
                                                                    const form = document.getElementById('deleteForm' + id);
                                                                    // Submit the form
                                                                    form.submit();

                                                                }
                                                            });
                                                        }
                                                    </script>

                                                    <div class="modal fade" id="editModal{{ $cart->no_detail }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">
                                                                        Edit Pembelian
                                                                    </h5>
                                                                </div>
                                                                <form
                                                                    action="{{ route('reseller.cart-update', $cart->no_detail) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <!-- Input fields for editing -->
                                                                        <div class="form-group">
                                                                            <p>Nama Barang:
                                                                                {{ $cart->barang->nama_barang }}
                                                                            </p>
                                                                            <p>Brand:
                                                                                {{ $cart->barang->brand->nama_brand }}
                                                                            </p>
                                                                            <p>Ukuran: {{ $cart->barang->ukuran }}</p>
                                                                            <p>Harga Satuan:
                                                                                Rp.
                                                                                {{ number_format($cart->barang->harga_jual, 0, ',', '.') }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="kuantitas">Kuantitas</label>
                                                                            <input type="text" class="form-control"
                                                                                id="kuantitas" placeholder="Nama Brand"
                                                                                name="kuantitas"
                                                                                value="{{ $cart->kuantitas }}">
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
                            <h3>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }} </h3>
                            <br>
                            <a href="{{ route('checkout-view', $transaksi->kode_transaksi) }}"
                                class="btn btn-success btn-icon-split btn-sm">
                                <span class="text">Checkout</span>
                            </a>
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

</body>

</html>
