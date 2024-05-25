@include('partials.header')


<body id="page-top">

          <!-- Custom fonts for this template -->
          <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
          <link
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">
      
          <!-- Custom styles for this template -->
          <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
      
          <!-- Custom styles for this page -->
          <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

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
                

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>kode barang</th>
                                            <th>nama barang</th>
                                            <th>harga</th>
                                            <th>deskripsi</th>
                                            <th>stok</th>
                                            <th>kategori</th>
                                            <th>warna</th>
                                            <th>ukuran</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{-- @foreach ( as )    
                                        <tr>
                                            <td>{{$barang->kode_barang}}</td>
                                            <td>{{$barang->nama_barang}}</td>
                                            <td>{{$barang->harga}}</td>
                                            <td>{{$barang->deskripsi}}</td>
                                            <td>{{$barang->stok}}</td>
                                            <td>{{$barang->kategori}}</td>
                                            <td>{{$barang->warna}}</td>
                                            <td>{{$barang->ukuran}}</td>
                                            <td>  <a href="{{route('barang.update', $barang->kode_barang)}}" class="btn btn-primary btn-icon-split">
                                                <span class="text">Edit</span>
                                            </a>
                                            <form action="{{ route('barang.delete', $barang->kode_barang) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                            
                                                <button type="submit" class="btn btn-danger btn-icon-split">
                                                    <span class="text">Hapus</span>
                                                </button>
                                            </form>
                                        </td>
                                        </tr>
                                        @endforeach --}}
                                        
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

@include('partials.script')

</body>

</html>