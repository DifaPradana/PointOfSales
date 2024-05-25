@include('partials.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.sidebar')
        @include('sweetalert::alert')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h1>Form Input Barang</h1>
                    <form action="{{ route('admin.barang-update', $barang->kode_barang) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div>
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required
                                value="{{ $barang->nama_barang }}">
                        </div>
                        <div>
                            <label for="harga">Harga:</label>
                            <input type="number" class="form-control" id="harga" name="harga" required
                                value="{{ $barang->harga }}">
                        </div>
                        <div>
                            <label for="deskripsi">Deskripsi:</label>
                            <input type="text" id="deskripsi" class="form-control" name="deskripsi" required
                                value="{{ $barang->deskripsi }}"></input>
                        </div>
                        <div>
                            <label for="stok">Stok:</label>
                            <input type="number" class="form-control" id="stok" name="stok" required
                                value="{{ $barang->stok }}">
                        </div>
                        <div>
                            <label for="kategori">Kategori:</label>
                            <select id="kategori" class="form-control" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="sandal" {{ $barang->kategori == 'sandal' ? 'selected' : '' }}>Sandal
                                </option>
                                <option value="sneakers" {{ $barang->kategori == 'sneakers' ? 'selected' : '' }}>
                                    Sneakers</option>
                            </select>
                            @if ($errors->has('kategori'))
                                <span class="text-danger">{{ $errors->first('kategori') }}</span>
                            @endif
                        </div>

                        <div>
                            <label for="warna">Warna:</label>
                            <input type="text" class="form-control" id="warna" name="warna" required
                                value="{{ $barang->warna }}">
                        </div>
                        <div>
                            <label for="ukuran">Ukuran:</label>
                            <input type="text" class="form-control" id="ukuran" name="ukuran" required
                                value="{{ $barang->ukuran }}">
                        </div>
                        <div class="mt-3">
                            <label for="gambar">Gambar:</label>
                            @if (isset($barang->gambar))
                                <div>
                                    <img src="{{ asset($barang->gambar) }}" alt="Gambar {{ $barang->nama_barang }}"
                                        style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" id="gambar" name="gambar" accept="image/*"
                                {{ isset($barang->gambar) }}>
                        </div>

                        <br>
                        <div class="form-group ">
                            <button class="btn btn-primary" type="submit">Simpan Data</button>
                        </div>

                    </form>
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
