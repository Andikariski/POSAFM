<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Fitur Menu</span>
                </li>

                
                 <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i>
                            <span class="hide-menu">Pelanggan </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('dataPelanggan') }}" class="sidebar-link">
                            <span class="hide-menu">Data Pelanggan</span></a>
                        </li>
                         <li class="sidebar-item"><a href="{{ route('dataPelangganPLN') }}" class="sidebar-link">
                            <span class="hide-menu">Data Pelanggan PLN</span></a>
                        </li>
                         {{-- <li class="sidebar-item"><a href="{{ route('dataAlamat') }}" class="sidebar-link">
                            <span class="hide-menu">Data Alamat</span></a>
                        </li> --}}
                    </ul>
                </li> 
                
                {{-- <li class="sidebar-item"> 
                    <a class="sidebar-link" href="{{ url('dataKasbond') }}" aria-expanded="false">
                        <i data-feather="truck" class="feather-icon"></i>
                        <span class="hide-menu">Pemasok</span>
                    </a>
                </li> --}}
                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="shopping-bag" class="feather-icon"></i>
                        <span class="hide-menu">Transaksi </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('transaksiPenjualan') }}" class="sidebar-link">
                            <span class="hide-menu">Transaksi Penjualan</span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('riwayatTransaksiPenjualan') }}" class="sidebar-link">
                            <span class="hide-menu">Riwayat Penjualan</span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('hutang') }}" class="sidebar-link">
                            <span class="hide-menu">Hutang</span></a>
                        </li>
                    </ul>
                </li>
                
                
                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="package" class="feather-icon"></i>
                            <span class="hide-menu">Produk </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('dataProduk') }}" class="sidebar-link">
                            <span class="hide-menu">Data Produk</span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('jenisProduk') }}" class="sidebar-link">
                            <span class="hide-menu">Data Jenis Produk</span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> 
                    <a class="sidebar-link" href="{{ route('laporan') }}" aria-expanded="false">
                        <i data-feather="bar-chart-2" class="feather-icon"></i>
                        <span class="hide-menu">Grafik Laporan</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Pengaturan</span></li>
                     <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="settings" class="feather-icon"></i><span class="hide-menu">Pengaturan</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ route('dataAlamat') }}" class="sidebar-link">
                                <span class="hide-menu">Alamat Pelanggan</span></a>
                            </li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link">
                                <span class="hide-menu">Tempat Produk</span></a>
                            </li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link">
                                <span class="hide-menu">Pemasok Barang</span></a>
                            </li>
                        </ul>
                    </li>
                {{-- <li class="sidebar-item"> 
                    <a class="sidebar-link sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>