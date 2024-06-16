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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah Barang
                        </button>

                        <br>
                        @if ($cart->isEmpty())
                            <br>
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
                            <a href="{{ route('checkout-view-admin', $transaksi->kode_transaksi) }}"
                                class="btn btn-success btn-icon-split btn-sm">
                                <span class="text">Checkout</span>
                            </a>
                        @endif
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form atau Konten Modal -->
                                <form action="{{ route('admin.cart-add') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang:</label>
                                        <select class="form-control" id="nama_barang" name="kode_barang" required>
                                            <option disabled selected value="">Pilih Barang</option>
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->kode_barang }}">{{ $b->nama_barang }} -- Ukuran
                                                    : {{ $b->ukuran }} -- Brand : {{ $b->brand->nama_brand }} --
                                                    Warna : {{ $b->warna }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kuantitas">Kuantitas:</label>
                                        <input type="number" class="form-control" id="kuantitas" name="kuantitas"
                                            required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



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

</body>

</html>
