<div class="col-md-12">
    <h2 class="text-gray-900">
        <i class="fas fa-list-alt"></i> Data Alternatif
    </h2>
    <p class="text-gray-900">Menampilkan data alternatif berdasarkan pilihan subkriteria supplier</p>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Alternatif</h5>
            <div>
                <a href="/spk-saw-supplier/alternatif/tambah" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>   

        <div class="card-body">
            <?php if (!empty($data['alternatif'])): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th><?= htmlspecialchars($k['nama_kriteria']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;foreach ($data['alternatif'] as $alternatif): ?>
                        <?php if (empty($alternatif['nilai'])) continue; ?> <!-- Lewati supplier tanpa nilai -->
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($alternatif['nama_supplier']) ?></td>
                            <?php foreach ($data['kriteria'] as $k): ?>
                                <?php
                                    $sub = '';
                                    foreach ($alternatif['nilai'] as $n) {
                                        if ($n['kode_kriteria'] === $k['kode_kriteria']) {
                                            if ($n['tipe_kriteria'] === 'benefit') {
                                                $sub = $n['nama_subkriteria']; // tampilkan nama subkriteria
                                            } else {
                                                $sub = $n['nilai']; // tampilkan nilai langsung (cost)
                                            }
                                            break;
                                        }
                                    }
                                ?>
                                <td><?= htmlspecialchars($sub) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="alert alert-info text-center">
                Belum ada data alternatif yang dimasukkan.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
