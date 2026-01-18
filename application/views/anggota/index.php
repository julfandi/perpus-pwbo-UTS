<!-- Begin Page Content -->
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Anggota</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahAnggotaModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Perpustakaan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>NIM</th>
                        <th>Nama Anggota</th>
                        <th>Telepon</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($anggota as $a) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $a->nim; ?></td>
                        <td><?= $a->nama_anggota; ?></td>
                        <td><?= $a->telepon; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAnggotaModal<?= $a->id ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('anggota/hapus/' . $a->id); ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editAnggotaModal<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data Anggota</h5>
                                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                                </div>
                                <form action="<?= base_url('anggota/edit'); ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $a->id ?>">
                                        <div class="form-group">
                                            <label>NIM</label>
                                            <input type="text" name="nim" class="form-control" value="<?= $a->nim ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Anggota</label>
                                            <input type="text" name="nama_anggota" class="form-control" value="<?= $a->nama_anggota ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" name="telepon" class="form-control" value="<?= $a->telepon ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahAnggotaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Anggota Baru</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="<?= base_url('anggota/tambah'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM..." required>
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input type="text" name="nama_anggota" class="form-control" placeholder="Masukkan nama lengkap..." required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="Contoh: 08123456789" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>