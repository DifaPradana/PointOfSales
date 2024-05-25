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

                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->


                <!-- Page Heading -->
                <h1 class="h3 mb-4 m-3 text-gray-800 ">{{ $title }}</h1>
                <div class="card shadow mb-4 m-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Produk</h6>
                    </div>
                    <br>

                    <div class="card-body">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID User</th>
                                        <th>Nama Reseller</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reseller as $reseller)
                                        <tr>
                                            <td>{{ $reseller->id_user }}</td>
                                            <td>{{ $reseller->nama_user }}</td>
                                            <td>{{ $reseller->alamat }}</td>
                                            <td>
                                                @if ($reseller->is_confirmed === 0)
                                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                                @elseif($reseller->is_confirmed === 1)
                                                    <span class="badge badge-success">Sudah Dikonfirmasi</span>
                                                @else
                                                    <span class="badge badge-secondary">Error</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.reseller.update-status', $reseller->id_user) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')

                                                    <button type="submit" class="btn btn-success btn-icon-split">
                                                        <span class="text">Konfirmasi</span>
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
