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
                        <h6 class="m-0 font-weight-bold text-primary">DataTables {{ $title }}</h6>
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

                                    <tr>
                                        @foreach ($reseller as $reseller)
                                            <td>{{ $reseller->id_user }}</td>
                                            <td>{{ $reseller->nama_user }}</td>
                                            <td>{{ $reseller->alamat }}</td>
                                            <td>
                                                @if ($reseller->status === 'Menunggu Konfirmasi')
                                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                                @elseif($reseller->status === 'Aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @elseif($reseller->status === 'Banned')
                                                    <span class="badge badge-danger">Banned</span>
                                                @else
                                                    <span class="badge badge-secondary">Error</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#editModal{{ $reseller->id_user }}"
                                                    class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="text">Edit</span>
                                                </button>


                                                <form id="deleteForm{{ $reseller->id_user }}"
                                                    action="{{ route('admin.reseller-delete', $reseller->id_user) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-icon-split btn-sm"
                                                        onclick="confirmDelete({{ $reseller->id_user }})">
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

                                                <div class="modal fade" id="editModal{{ $reseller->id_user }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit
                                                                    Reseller
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.reseller.update-status', $reseller->id_user) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <!-- Input fields for editing -->
                                                                    <div class="form-group">
                                                                        <label for="status">Status</label>
                                                                        <select class="form-control" name="status"
                                                                            id="status">
                                                                            <option value="Menunggu Konfirmasi"
                                                                                {{ $reseller->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>
                                                                                Menunggu Konfirmasi</option>
                                                                            <option value="Banned"
                                                                                {{ $reseller->status == 'Banned' ? 'selected' : '' }}>
                                                                                Banned</option>
                                                                            <option value="Aktif"
                                                                                {{ $reseller->status == 'Aktif' ? 'selected' : '' }}>
                                                                                Aktif</option>
                                                                        </select>
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
                                </tbody>



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
