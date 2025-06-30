<?php
class RankingakhirController extends Controller
{
    public function index()
    {
        $model_alternatif = $this->model('Alternatif');
        $alternatif = $model_alternatif->getAll();

        $model_kriteria = $this->model('Kriteria');
        $kriteria = $model_kriteria->getAll();

        // Ambil bobot & tipe
        $bobot = [];
        $tipe = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode_kriteria']] = (float) $k['bobot_kriteria'];
            $tipe[$k['kode_kriteria']] = $k['tipe_kriteria'];
        }

        // Matriks keputusan + cari max/min
        $matrix = [];
        $max = [];
        $min = [];

        foreach ($alternatif as &$a) {
            $matrix[$a['id']] = [];
            foreach ($a['nilai'] as $n) {
                $kode = $n['kode_kriteria'];
                $nilai = (float) $n['nilai_subkriteria'];
                $matrix[$a['id']][$kode] = $nilai;

                if (!isset($max[$kode]) || $nilai > $max[$kode]) {
                    $max[$kode] = $nilai;
                }
                if (!isset($min[$kode]) || $nilai < $min[$kode]) {
                    $min[$kode] = $nilai;
                }
            }
        }

        // Normalisasi
        foreach ($alternatif as &$a) {
            $a['normalisasi'] = [];
            foreach ($matrix[$a['id']] as $kode => $nilai) {
                if ($tipe[$kode] === 'benefit') {
                    $norm = $max[$kode] != 0 ? $nilai / $max[$kode] : 0;
                } else {
                    $norm = $nilai != 0 ? $min[$kode] / $nilai : 0;
                }
                $a['normalisasi'][$kode] = round($norm, 4);
            }
        }

        // Hitung nilai akhir
        $ranking = [];
        foreach ($alternatif as &$a) {
            $nilai_akhir = 0;
            foreach ($a['normalisasi'] as $kode => $norm) {
                $nilai_akhir += $norm * $bobot[$kode];
            }
            $a['nilai_akhir'] = round($nilai_akhir, 4);
            $ranking[] = [
                'nama_supplier' => $a['nama_supplier'],
                'nilai_akhir' => $a['nilai_akhir']
            ];
        }

        // Urutkan ranking
        usort($ranking, function ($a, $b) {
            if ($a['nilai_akhir'] == $b['nilai_akhir']) {
                return 0;
            }
            return ($a['nilai_akhir'] < $b['nilai_akhir']) ? 1 : -1;
        });


        // Kirim ke view
        $data = [
            'ranking' => $ranking,
        ];

        $this->view('rankingakhir/index', $data);
    }

    public function cetak()
    {
        $model_alternatif = $this->model('Alternatif');
        $alternatif = $model_alternatif->getAll();

        $model_kriteria = $this->model('Kriteria');
        $kriteria = $model_kriteria->getAll();

        // Ambil bobot & tipe
        $bobot = [];
        $tipe = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode_kriteria']] = (float) $k['bobot_kriteria'];
            $tipe[$k['kode_kriteria']] = $k['tipe_kriteria'];
        }

        // Matriks keputusan + cari max/min
        $matrix = [];
        $max = [];
        $min = [];

        foreach ($alternatif as &$a) {
            $matrix[$a['id']] = [];
            foreach ($a['nilai'] as $n) {
                $kode = $n['kode_kriteria'];
                $nilai = (float) $n['nilai_subkriteria'];
                $matrix[$a['id']][$kode] = $nilai;

                if (!isset($max[$kode]) || $nilai > $max[$kode]) {
                    $max[$kode] = $nilai;
                }
                if (!isset($min[$kode]) || $nilai < $min[$kode]) {
                    $min[$kode] = $nilai;
                }
            }
        }

        // Normalisasi
        foreach ($alternatif as &$a) {
            $a['normalisasi'] = [];
            foreach ($matrix[$a['id']] as $kode => $nilai) {
                if ($tipe[$kode] === 'benefit') {
                    $norm = $max[$kode] != 0 ? $nilai / $max[$kode] : 0;
                } else {
                    $norm = $nilai != 0 ? $min[$kode] / $nilai : 0;
                }
                $a['normalisasi'][$kode] = round($norm, 4);
            }
        }

        // Hitung nilai akhir
        $ranking = [];
        foreach ($alternatif as &$a) {
            $nilai_akhir = 0;
            foreach ($a['normalisasi'] as $kode => $norm) {
                $nilai_akhir += $norm * $bobot[$kode];
            }
            $a['nilai_akhir'] = round($nilai_akhir, 4);
            $ranking[] = [
                'nama_supplier' => $a['nama_supplier'],
                'nilai_akhir' => $a['nilai_akhir']
            ];
        }

        // Urutkan ranking
        usort($ranking, function ($a, $b) {
            if ($a['nilai_akhir'] == $b['nilai_akhir']) {
                return 0;
            }
            return ($a['nilai_akhir'] < $b['nilai_akhir']) ? 1 : -1;
        });

        echo '<html><head><title>Cetak</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>@media print { .no-print { display: none; } }</style>
            </head><body>';
        echo '<div class="container mt-4">';
        echo '<h3 class="text-center mb-4">Laporan Hasil Akhir Perankingan</h3>';
        echo '<table class="table table-bordered table-sm"><thead><tr>
                <th class="text-center">Rank</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Nilai Akhir</th>
            </tr></thead><tbody>';

        $rank = 1;
        foreach ($ranking as $r) {
            echo '<tr>
                    <td class="text-center">' . $rank++ . '</td>
                    <td>' . htmlspecialchars($r['nama_supplier']) . '</td>
                    <td class="text-center">' . htmlspecialchars($r['nilai_akhir']) . '</td>
                </tr>';
        }

        echo '</tbody></table>';
        echo '<div class="text-center no-print mt-4">
                <button class="btn btn-primary" onclick="window.print()">Cetak / Print</button>
                <a href="/spk-saw-supplier/rankingakhir" class="btn btn-secondary">Kembali</a>
            </div>';
        echo '</div></body></html>';
    }
}
