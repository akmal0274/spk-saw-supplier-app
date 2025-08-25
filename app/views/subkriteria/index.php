<div class="col-md-12">
    <h2 class="text-gray-900">
        <i class="fas fa-list-alt"></i> Data Sub Kriteria
    </h2>
    <div class="alert alert-info mt-3" role="alert">
        <i class="fas fa-info-circle"></i>
        <strong>Info:</strong> Untuk <span class="text-danger">kriteria dengan tipe <em>Cost</em></span>, 
        nilai tidak dimasukkan di sini, tetapi langsung di <b>Data Alternatif</b>.
    </div>
    <?php foreach ($data['kriteria'] as $k): ?>
        <?php if ($k['tipe_kriteria'] == 'benefit'): ?>
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title text-gray-900">
                        <?= htmlspecialchars($k['kode_kriteria']) ?> - <?= htmlspecialchars($k['nama_kriteria']) ?>
                    </h5>
                    <a href="/spk-saw-supplier/subkriteria/tambah/<?= $k['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Subkriteria
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Subkriteria</th>
                                <th>Bobot Subkriteria</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sub_found = false;
                            $no = 1;
                            foreach ($data['subkriteria'] as $sub):
                                if ($sub['id_kriteria'] == $k['id']):
                                    $sub_found = true;
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($sub['nama_subkriteria']) ?></td>
                                <td><?= htmlspecialchars($sub['nilai_subkriteria']) ?></td>
                                <td>
                                    <a href="/spk-saw-supplier/subkriteria/edit/<?= $sub['id'] ?>" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/spk-saw-supplier/subkriteria/hapus/<?= $sub['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus subkriteria ini?')">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>

                            <?php if (!$sub_found): ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada subkriteria untuk kriteria ini</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
