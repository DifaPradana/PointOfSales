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
                <h1 class="h3 mb-4 m-3 text-gray-800">Data Produk</h1>
                <div class="card shadow mb-4 m-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>

                    <br>
                    <form method="POST" action="{{ route('admin.tambah-stok') }}">
                        @csrf
                        <div class="form-group col-md-4">
                            <label for="nama_barang">Nama Barang:</label>
                            <select type="text" class="form-control" id="nama_barang" name="kode_barang" required
                                value="">
                                <option disabled selected value="">Pilih Barang</option>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->kode_barang }}">{{ $b->nama_barang }} {{ $b->warna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nama_barang">Jumlah Stok Barang:</label>
                            <input type="number" class="form-control" id="stok" name="stok" required
                                value="">
                        </div>

                        <div class="form-group col-md-4">
                            <button class="btn btn-primary" type="submit">Tambah Stok</button>
                        </div>
                    </form>
                    <div class="card-body">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Deskripsi</th>
                                        <th>Tipe</th>
                                        <th>Stok</th>
                                        <th>Brand</th>
                                        <th>Warna</th>
                                        <th>Ukuran</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $barang)
                                        <tr>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->harga_beli }}</td>
                                            <td>{{ $barang->harga_jual }}</td>
                                            <td>{{ $barang->deskripsi }}</td>
                                            <td>{{ $barang->tipe }}</td>
                                            <td>{{ $barang->stok }}</td>
                                            @foreach ($brand as $d)
                                                @if ($d->kode_brand == $barang->kode_brand)
                                                    <td>{{ $d->nama_brand }}</td>
                                                @endif
                                            @endforeach
                                            <td>{{ $barang->warna }}</td>
                                            <td>{{ $barang->ukuran }}</td>
                                            <td> <a href="{{ route('admin.view-barang-update', $barang->kode_barang) }}"
                                                    class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="text">Edit</span>
                                                </a>


                                                <form action="{{ route('admin.barang-delete', $barang->kode_barang) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon-split btn-sm">
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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

</body>

</html>
