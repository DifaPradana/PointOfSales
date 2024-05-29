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
                    <form action="{{ route('admin.input-barang-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <br>
                        <div>
                            <label for="harga">Harga Beli:</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <br>
                        <div>
                            <label for="harga">Harga Jual:</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                        </div>
                        <br>
                        <div>
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea id="deskripsi" class="form-control" name="deskripsi" required></textarea>
                        </div>
                        <br>
                        <div>
                            <label for="tipe">Tipe:</label>
                            <input type="text" class="form-control" id="tipe" name="tipe" required>
                        </div>
                        <br>
                        <div>
                            <label for="stok">Stok:</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <br>
                        <div>
                            <label for="kode_brand">Brand:</label>
                            <select id="kode_brand" class="form-control" name="kode_brand" required>
                                <option value="">Pilih Brand</option>
                                @foreach ($brand as $brand)
                                    <option value="{{ $brand->kode_brand }}">{{ $brand->nama_brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="warna">Warna:</label>
                            <select id="warna" class="form-control" name="warna" required>
                                <option value="">Pilih warna</option>
                                <option value="merah">Merah</option>
                                <option value="biru">Biru</option>
                                <option value="kuning">Kuning</option>
                                <option value="hijau">Hijau</option>
                                <option value="ungu">Ungu</option>
                                <option value="hitam">Hitam</option>
                                <option value="putih">Putih</option>
                                <option value="abu-abu">Abu-abu</option>
                                <option value="coklat">Coklat</option>
                                <option value="orange">Orange</option>
                                <option value="pink">Pink</option>
                            </select>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="ukuran">Ukuran:</label>
                            <input type="number" class="form-control" id="ukuran" name="ukuran" required>
                        </div>
                        <br>
                        <div class="mt-3">
                            <label for="gambar">Gambar:</label>
                            <input type="file" id="gambar" name="gambar" accept="image/*" required>
                        </div>
                        <br>
                        <div class="mt-3">
                            <img id="gambar-preview" src="#" alt="Preview Gambar"
                                style="display: none; max-width: 200px;">
                        </div>
                        <br>
                        <div class="form-group ">
                            <button class="btn btn-primary" type="submit">Tambah Data</button>
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
    <script>
        document.getElementById('gambar').addEventListener('change', function(event) {
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
