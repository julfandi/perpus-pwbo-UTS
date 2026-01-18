<!-- Begin Page Content -->
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Buku</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahBukuModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Buku
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Koleksi Buku</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th width="8%">Stok</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($buku as $b) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $b->judul; ?></td>
                        <td>
                            <?php 
                                if (!empty($b->daftar_kategori)) {
                                    $tags = explode(', ', $b->daftar_kategori);
                                    foreach($tags as $t) {
                                        echo '<span class="badge badge-info mr-1">'.$t.'</span>';
                                    }
                                } else {
                                    echo '<span class="badge badge-secondary">Tanpa Kategori</span>';
                                }
                            ?>
                        </td>
                        <td><?= $b->penulis; ?></td>
                        <td><?= $b->penerbit; ?></td>
                        <td><?= $b->stok; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBukuModal<?= $b->id ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('buku/hapus/' . $b->id); ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editBukuModal<?= $b->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Buku</h5>
                                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                                </div>
                                <form action="<?= base_url('buku/edit'); ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $b->id ?>">
                                        <div class="form-group">
                                            <label>Judul Buku</label>
                                            <input type="text" name="judul" class="form-control" value="<?= $b->judul ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori (Pilih banyak)</label><br>
                                            <?php foreach($kategori as $k) : ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kategori_ids[]" 
                                                           value="<?= $k->id ?>" 
                                                           id="edit_kat<?= $b->id ?>_<?= $k->id ?>"
                                                           <?= in_array($k->id, $b->kategori_terpilih) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="edit_kat<?= $b->id ?>_<?= $k->id ?>">
                                                        <?= $k->nama_kategori ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Penulis</label>
                                            <input type="text" name="penulis" class="form-control" value="<?= $b->penulis ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input type="text" name="penerbit" class="form-control" value="<?= $b->penerbit ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="number" name="stok" class="form-control" value="<?= $b->stok ?>" required>
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

<div class="modal fade" id="tambahBukuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku Baru</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="<?= base_url('buku/tambah'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                    </div>
                    <div class="form-group">
                        <label>Kategori (Pilih banyak)</label><br>
                        <?php foreach($kategori as $k) : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="kategori_ids[]" value="<?= $k->id ?>" id="add_kat<?= $k->id ?>">
                                <label class="form-check-label" for="add_kat<?= $k->id ?>"><?= $k->nama_kategori ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" name="penulis" class="form-control" placeholder="Nama penulis..." required>
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit..." required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" placeholder="0" required>
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