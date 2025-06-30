<div class="col-md-12">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="text-gray-900 mb-4">
            <i class="fas fa-medal"></i> Data Hasil Akhir
        </h2>
        <a href="/spk-saw-supplier/rankingakhir/cetak" class="btn btn-secondary">
            <i class="fas fa-print"></i> Cetak Data
        </a>
    </div>
    

    <!-- Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-table"></i> Hasil Akhir Perankingan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle text-center">Rank</th>
                        <th class="align-middle text-center">Supplier</th>
                        <th class="align-middle text-center">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rank = 1;
                    foreach ($data['ranking'] as $r): 
                    ?>
                    <tr>
                        <td class="align-middle text-center"><?= $rank++ ?></td>
                        <td><?= htmlspecialchars($r['nama_supplier']) ?></td>
                        <td class="align-middle text-center"><?= htmlspecialchars($r['nilai_akhir']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
