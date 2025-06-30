<div class="col-md-12">
    <h2 class="text-gray-900">
        <i class="fas fa-list-alt"></i> Data Supplier
    </h2>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Supplier</h5>
            <div>
                <a href="/spk-saw-supplier/supplier/tambah" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="/spk-saw-supplier/supplier/cetak" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak Data
                </a>
            </div>
        </div>   
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['supplier']) > 0): ?>
                        <?php $no = 1; foreach ($data['supplier'] as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['nama_supplier']) ?></td>
                            <td>
                                <a href="/spk-saw-supplier/supplier/edit/<?= $k['id'] ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/spk-saw-supplier/supplier/hapus/<?= $k['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus kriteria ini?')">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data supplier</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
