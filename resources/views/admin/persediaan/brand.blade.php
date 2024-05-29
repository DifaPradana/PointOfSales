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
                        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                    </div>
                    <br>
                    <form method="POST" action="{{ route('admin.brand-store') }}">
                        @csrf

                        <div class="form-group col-md-4">
                            <label for="nama_brand">Nama Brand :</label>
                            <input type="text" class="form-control" id="nama_brand" name="nama_brand" required
                                value="">
                        </div>

                        <div class="form-group col-md-4">
                            <button class="btn btn-primary" type="submit">Buat</button>
                        </div>
                    </form>
                    <div class="card-body">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>nama barang</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brand as $brand)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $brand->nama_brand }}</td>
                                            <td>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#editModal{{ $brand->kode_brand }}"
                                                    class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="text">Edit</span>
                                                </button>


                                                <form id="deleteForm{{ $brand->kode_brand }}"
                                                    action="{{ route('admin.brand-delete', $brand->kode_brand) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-icon-split btn-sm"
                                                        onclick="confirmDelete({{ $brand->kode_brand }})">
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

                                                <div class="modal fade" id="editModal{{ $brand->kode_brand }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit Brand
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.brand-update', $brand->kode_brand) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <!-- Input fields for editing -->
                                                                    <div class="form-group">
                                                                        <label for="nama_brand">Kode
                                                                            Brand</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_brand" placeholder="Nama Brand"
                                                                            name="nama_brand"
                                                                            value="{{ $brand->nama_brand }}">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
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
