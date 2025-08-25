<div class="col-md-12">
    <h2 class="text-gray-900 mb-4">
        <i class="fas fa-calculator"></i> Perhitungan SAW
    </h2>

    <!-- Bobot Preferensi -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-table"></i> Bobot Preferensi (W)</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['kriteria'] as $k): ?>
                    <tr>
                        <td><?= htmlspecialchars($k['kode_kriteria']) ?></td>
                        <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                        <td><?= htmlspecialchars($k['bobot_kriteria']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Matriks Keputusan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-table"></i> Matriks Keputusan (X)</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th rowspan="2" class="align-middle text-center">No</th>
                        <th rowspan="2" class="align-middle text-center">Supplier</th>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="align-middle text-center"><?= htmlspecialchars($k['kode_kriteria']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="align-middle text-center"><small><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></small></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Siapkan untuk max min
                    $max = [];
                    $min = [];
                    ?>
                    <?php $no=1; foreach ($data['alternatif'] as $a): ?>
                        <tr>
                            <td class="align-middle text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($a['nama_supplier']) ?></td>
                            <?php foreach ($data['kriteria'] as $k): ?>
                                <td class="align-middle text-center">
                                <?php
                                $nilai_sub = '-';
                                foreach ($a['nilai'] as $n) {
                                    if ($n['kode_kriteria'] === $k['kode_kriteria']) {
                                        $nilai_sub = $n['nilai'];

                                        // Hitung max min
                                        if (!isset($max[$k['kode_kriteria']]) || $nilai_sub > $max[$k['kode_kriteria']]) {
                                            $max[$k['kode_kriteria']] = $nilai_sub;
                                        }
                                        if (!isset($min[$k['kode_kriteria']]) || $nilai_sub < $min[$k['kode_kriteria']]) {
                                            $min[$k['kode_kriteria']] = $nilai_sub;
                                        }

                                        break;
                                    }
                                }
                                echo htmlspecialchars($nilai_sub);
                                ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="thead-light">
                    <tr>
                        <th colspan="2" class="align-middle text-center">Max</th>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="align-middle text-center"><?= isset($max[$k['kode_kriteria']]) ? htmlspecialchars($max[$k['kode_kriteria']]) : '-' ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th colspan="2" class="align-middle text-center">Min</th>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="align-middle text-center" ><?= isset($min[$k['kode_kriteria']]) ? htmlspecialchars($min[$k['kode_kriteria']]) : '-' ?></th>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <!-- Matriks Ternormalisasi -->
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-table"></i> Matriks Ternormalisasi (R)</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th rowspan="2" class="align-middle text-center">No</th>
                        <th rowspan="2" class="align-middle text-center">Supplier</th>
                        <?php $no_kriteria = 1; ?>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="align-middle text-center"><?= 'R' . $no_kriteria++ ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="text-center"><small><?= ucfirst($k['tipe_kriteria']) ?></small></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($data['alternatif'] as $a): ?>
                        <tr>
                            <td class="align-middle text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($a['nama_supplier']) ?></td>
                            <?php foreach ($data['kriteria'] as $k): ?>
                                <td class="align-middle text-center">
                                    <?php
                                        $kode = $k['kode_kriteria'];
                                        $tipe = $k['tipe_kriteria'];

                                        $nilai = isset($matrix[$a['id']][$kode]) ? $matrix[$a['id']][$kode] : null;
                                        $hasil = isset($a['normalisasi'][$kode]) ? $a['normalisasi'][$kode] : null;

                                        $maxval = isset($max[$kode]) ? $max[$kode] : null;
                                        $minval = isset($min[$kode]) ? $min[$kode] : null;

                                        if ($nilai !== null && $hasil !== null) {
                                            if ($tipe === 'benefit') {
                                                echo "{$nilai} / {$maxval} = " . number_format($hasil, 2);
                                            } else {
                                                echo "{$minval} / {$nilai} = " . number_format($hasil, 2);
                                            }
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                    <!-- Baris Bobot Kriteria -->
                <tfoot class="thead-light">
                    <tr>
                        <th colspan="2" class="align-middle text-center">Bobot</th>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <th class="text-center">
                                <?= htmlspecialchars($k['bobot_kriteria']) ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <!-- Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0"><i class="fas fa-table"></i> Perankingan</h5>
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
