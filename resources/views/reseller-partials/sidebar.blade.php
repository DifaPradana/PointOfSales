        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('reseller.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reseller.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Persediaan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Persediaan:</h6>
                        <a class="collapse-item" href="{{ route('admin.brand-view') }}">Table Data Brand</a>
                        <a class="collapse-item" href="{{ route('admin.input-barang') }}">Tambah Data Barang</a>
                        <a class="collapse-item" href="{{ route('admin.tabel-barang') }}">Table Data Barang</a>

                    </div>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="{{ route('reseller.produk') }}">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <span>List Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('reseller.cart') }}">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    <span>Cart</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('reseller.pembelian') }}">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span>Pembelian</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('reseller.dashboard') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reseller</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pesanan.dashboard') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>kelola pesanan</span>
                </a>

            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('checkout.dashboard') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Checkout</span>
                </a>

            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.dashboard') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>laporan</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
