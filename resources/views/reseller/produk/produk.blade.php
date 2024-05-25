@include('partials.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')
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
                                <div class="card h-100">
                                    @if (isset($item->gambar))
                                        <img src="{{ asset($item->gambar) }}" class="card-img-top"
                                            alt="Gambar {{ $item->nama_barang }}" style="border-radius: 10px;">
                                    @endif

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->nama_barang }}</h5>
                                        <p class="card-text">Stock: {{ $item->stok }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
