        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PERPUS<sup>KU</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Data Master
            </div>

            <?php 
                $master_active = in_array($this->uri->segment(1), ['kategori', 'buku', 'anggota']);
            ?>
            <li class="nav-item <?= $master_active ? 'active' : '' ?>">
                <a class="nav-link <?= $master_active ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="<?= $master_active ? 'true' : 'false' ?>" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse <?= $master_active ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($this->uri->segment(1) == 'kategori') ? 'active' : '' ?>" href="<?= base_url('kategori'); ?>">Kategori</a>
                        <a class="collapse-item <?= ($this->uri->segment(1) == 'buku') ? 'active' : '' ?>" href="<?= base_url('buku'); ?>">Buku</a>
                        <a class="collapse-item <?= ($this->uri->segment(1) == 'anggota') ? 'active' : '' ?>" href="<?= base_url('anggota'); ?>">Anggota</a>
                    </div>
                </div>
            </li>

            <div class="sidebar-heading">
                Data Transaksi
            </div>

            <?php 
                $transaksi_active = ($this->uri->segment(1) == 'peminjaman');
            ?>
            <li class="nav-item <?= $transaksi_active ? 'active' : '' ?>">
                <a class="nav-link <?= $transaksi_active ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="<?= $transaksi_active ? 'true' : 'false' ?>" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse <?= $transaksi_active ? 'show' : '' ?>" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($this->uri->segment(1) == 'peminjaman') ? 'active' : '' ?>" href="<?= base_url('peminjaman'); ?>">Peminjaman</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout'); ?>" onclick="return confirm('Yakin ingin keluar dari sistem?')">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url('/assets/img/undraw_profile.svg')?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->