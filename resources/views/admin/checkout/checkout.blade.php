@include('reseller-partials.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('reseller-partials.sidebar')
        @include('sweetalert::alert')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('reseller-partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h1>Form Input Barang</h1>

                    <form action="{{ route('checkout-admin', $transaksi->kode_transaksi) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <br>
                        <div>
                            <label for="nama_penerima">Nama Penerima:</label>
                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="alamat_penerima" id="alamat_penerima">
                            <input type="hidden" name="kuantitas" value="-">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="harga_ongkir" id="harga_ongkir">
                            <input type="hidden" name="harga_ongkir" value="0">
                        </div>

                        <div class="form-group">
                            <label for="total_bayar">Total Harga Item:</label>
                            <p id="total_bayar_item" name="total_bayar" class="form-control" style="height: auto;">
                                Rp.
                                {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
                        </div>
                        <br>
                        <div class="form-group ">
                            <button class="btn btn-success" type="submit">Checkout</button>
                            {{-- @dd($transaksi->kode_transaksi) --}}
                            {{-- <a href="{{ route('checkout', $transaksi->kode_transaksi) }}"
                                class="btn btn-danger">Back</a> --}}
                        </div>
                    </form>
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
        function updateOngkir() {
            const ekspedisi = document.getElementById('ekspedisi').value;
            const hargaOngkir = document.getElementById('harga_ongkir');
            const hargaOngkirDisplay = document.getElementById('harga_ongkir_display');

            let ongkir = 0;

            switch (ekspedisi) {
                case 'jnt':
                    ongkir = 15000; // Contoh harga ongkir untuk JNT
                    break;
                case 'jne':
                    ongkir = 20000; // Contoh harga ongkir untuk JNE
                    break;
                case 'lion_parcel':
                    ongkir = 25000; // Contoh harga ongkir untuk Lion Parcel
                    break;
                default:
                    ongkir = 0;
                    break;
            }

            hargaOngkir.value = ongkir;
            hargaOngkirDisplay.textContent = 'Rp. ' + ongkir.toLocaleString();
        }
    </script>

    {{-- <script>
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
    </script> --}}


</body>

</html>
