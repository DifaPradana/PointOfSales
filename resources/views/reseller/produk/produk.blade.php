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
                    <div class="row">
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Produk</h1>
                </div>


                <div class="container-fluid">
                    <div class="row">
                        @foreach ($barang as $item)
                            <div class="col-md-4 mb-4">
                                <form action="{{ route('reseller.cart-add', $item->kode_barang) }}" method="POST">
                                    @csrf
                                    <div class="card h-100">
                                        @if (isset($item->gambar))
                                            <img src="{{ asset($item->gambar) }}" class="card-img-top"
                                                alt="Gambar {{ $item->nama_barang }}"
                                                style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{ $item->nama_barang }}</h5>
                                            <p class="card-text mb-1">Stock: {{ $item->stok }}</p>
                                            <p class="card-text mb-1">Harga: Rp.
                                                {{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                                            <p class="card-text mb-1">Brand: {{ $item->brand->nama_brand }}</p>
                                            <br>
                                            <div class="col d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary flex-fill mx-1"
                                                    data-toggle="modal"
                                                    data-target="#editModal{{ $item->kode_barang }}">
                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                </button>
                                                <input type="hidden" name="kode_barang"
                                                    value="{{ $item->kode_barang }}">
                                                <input type="hidden" name="kuantitas" value="1">
                                                <button type="submit" class="btn btn-success flex-fill mx-1">
                                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $item->kode_barang }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">{{ $item->nama_barang }}
                                                </h5>
                                            </div>
                                            <div class="modal-body row">
                                                @if (isset($item->gambar))
                                                    <img src="{{ asset($item->gambar) }}" class="card-img-top"
                                                        alt="Gambar {{ $item->nama_barang }}"
                                                        style="border-radius: 10px;">
                                                @endif
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1">Stock: {{ $item->stok }}</p>
                                                    <p class="card-text mb-1">Harga: Rp.
                                                        {{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1">Deskripsi: {{ $item->deskripsi }}</p>
                                                    <p class="card-text mb-1">Tipe: {{ $item->tipe }}</p>
                                                    <p class="card-text mb-1">Brand: {{ $item->brand->nama_brand }}</p>
                                                    <p class="card-text mb-1">Warna: {{ $item->warna }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <form action="{{ route('reseller.cart-add', $item->kode_barang) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="kode_barang"
                                                        value="{{ $item->kode_barang }}">
                                                    <input type="hidden" name="kuantitas" value="1">
                                                    <button type="submit" class="btn btn-success flex-fill mx-1">
                                                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->
                            </div>
                        @endforeach
                    </div>
                </div>

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
