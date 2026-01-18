<!-- Begin Page Content -->
<div class="container-fluid">
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Peminjaman</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#pinjamModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Pinjam Buku
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Pinjam</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($peminjaman as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->nama_anggota ?></td>
                        <td><?= $p->judul ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tgl_pinjam)) ?></td>
                        <td><?= $p->tgl_kembali ? date('d/m/Y', strtotime($p->tgl_kembali)) : '-' ?></td>
                        <td>Rp <?= number_format($p->denda, 0, ',', '.') ?></td>
                        <td>
                            <span class="badge badge-<?= $p->status == 'dipinjam' ? 'warning' : 'success' ?>">
                                <?= ucfirst($p->status) ?>
                            </span>
                        </td>
                        <td>
                            <?php if($p->status == 'dipinjam'): ?>
                                <a href="<?= base_url('peminjaman/kembalikan/'.$p->id.'/'.$p->buku_id) ?>" 
                                   class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pengembalian?')">
                                   <i class="fas fa-check"></i> Kembali
                                </a>
                            <?php else: ?>
                                <button class="btn btn-light btn-sm" disabled>Selesai</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="pinjamModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h5>Input Peminjaman</h5></div>
            <form action="<?= base_url('peminjaman/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Anggota</label>
                        <select name="anggota_id" class="form-control" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach($anggota as $a): ?>
                                <option value="<?= $a->id ?>"><?= $a->nim ?> - <?= $a->nama_anggota ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Buku</label>
                        <select name="buku_id" class="form-control" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach($buku as $b): ?>
                                <?php if($b->stok > 0): ?>
                                    <option value="<?= $b->id ?>"><?= $b->judul ?> (Tersedia: <?= $b->stok ?>)</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>