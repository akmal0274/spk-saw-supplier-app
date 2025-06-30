<div class="col-md-12">
    <h2 class="text-gray-900">
        <i class="fas fa-list-alt"></i> Data Kriteria
    </h2>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Kriteria</h5>
            <div>
                <a href="/spk-saw-supplier/kriteria/tambah" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="/spk-saw-supplier/kriteria/cetak" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak Data
                </a>
            </div>
        </div>   
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Kriteria</th>
                        <th>Tipe</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['kriteria']) > 0): ?>
                        <?php $no = 1; foreach ($data['kriteria'] as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['kode_kriteria']) ?></td>
                            <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                            <td><?= htmlspecialchars($k['tipe_kriteria']) ?></td>
                            <td><?= htmlspecialchars($k['bobot_kriteria']) ?></td>
                            <td>
                                <a href="/spk-saw-supplier/kriteria/edit/<?= $k['id'] ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/spk-saw-supplier/kriteria/hapus/<?= $k['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus kriteria ini?')">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data kriteria</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
