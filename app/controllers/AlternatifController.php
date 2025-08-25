<?php
class AlternatifController extends Controller {
    public function index() {
        $model_kriteria = $this->model('Kriteria');
        $data['kriteria'] = $model_kriteria->getAll();
        $model_alternatif = $this->model('Alternatif');
        $data['alternatif'] = $model_alternatif->getAll();
        $this->view('alternatif/index', $data);
    }

    public function tambah() {
        $model_supplier = $this->model('Supplier');
        $data['supplier'] = $model_supplier->getAll();

        $model_kriteria = $this->model('Kriteria');
        $data['kriteria'] = $model_kriteria->getAll();

        $model_subkriteria = $this->model('Subkriteria');
        $data['subkriteria'] = $model_subkriteria->getAll();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['login_error'] = "CSRF token tidak valid! Harap login kembali.";
                header('Location: /spk-saw-supplier/auth/login');
                exit;
            }

            $id_supplier = isset($_POST['id_supplier']) ? $_POST['id_supplier'] : null;
            $subkriteria = isset($_POST['subkriteria']) ? $_POST['subkriteria'] : [];


            if (!$id_supplier || empty($subkriteria)) {
                $_SESSION['message'] = "Data tidak lengkap. Harap isi semua form.";
                $_SESSION['alert-type'] = "danger";
                header('Location: /spk-saw-supplier/alternatif/tambah');
                exit;
            }

            $model_nilai = $this->model('Alternatif');

            $sukses = true;

            foreach ($data['kriteria'] as $kriteria) {
                $id_kriteria = $kriteria['id'];
                $tipe = $kriteria['tipe_kriteria'];

                if (!isset($subkriteria[$id_kriteria]) || $subkriteria[$id_kriteria] === '') {
                    $sukses = false;
                    break;
                }

                if ($tipe === 'benefit') {
                    // isi berupa id_subkriteria
                    $id_sub = (int)$subkriteria[$id_kriteria];
                    $result = $model_nilai->insert($id_supplier, $id_kriteria, $id_sub, null);
                } else {
                    // isi berupa nilai langsung (cost)
                    $nilai = (int)$subkriteria[$id_kriteria];
                    $result = $model_nilai->insert($id_supplier, $id_kriteria, null, $nilai);
                }

                if (!$result) {
                    $sukses = false;
                    break;
                }
            }


            if ($sukses) {
                $_SESSION['message'] = "Data alternatif berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            } else {
                $_SESSION['message'] = "Gagal menyimpan data alternatif.";
                $_SESSION['alert-type'] = "danger";
            }

            header('Location: /spk-saw-supplier/alternatif');
            exit;
        }

        // Tampilkan form
        $this->view('alternatif/tambah', $data);
    }


    public function edit($id) {
        $model = $this->model('Kriteria');
        $data['kriteria'] = $model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['login_error'] = "CSRF token tidak valid! Harap login kembali.";
                header('Location: /spk-saw-supplier/auth/login');
                exit;
            }
            $result = $model->update($id, $_POST['nama_kriteria'], $_POST['tipe_kriteria'],$_POST['bobot_kriteria']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan kriteria. Kode mungkin sudah ada atau data tidak valid.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Kriteria berhasil diedit.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/kriteria');
            exit;
        }

        $this->view('kriteria/edit', $data);
    }

    public function hapus($id) {
        $model = $this->model('Kriteria');
        $model->delete($id);
        header('Location: /spk-saw-supplier/kriteria');
    }

    public function cetak() {
        $model = $this->model('Kriteria');
        $kriteria = $model->getAll();

        echo '<html><head><title>Cetak</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>@media print { .no-print { display: none; } }</style>
            </head><body>';
        echo '<div class="container mt-4">';
        echo '<h3 class="text-center mb-4">Laporan Data Kriteria</h3>';
        echo '<table class="table table-bordered"><thead><tr>
                <th>Kode</th><th>Nama</th><th>Tipe</th><th>Bobot</th>
            </tr></thead><tbody>';

        foreach ($kriteria as $row) {
            echo '<tr>
                    <td>'.htmlspecialchars($row['kode_kriteria']).'</td>
                    <td>'.htmlspecialchars($row['nama_kriteria']).'</td>
                    <td>'.htmlspecialchars($row['tipe_kriteria']).'</td>
                    <td>'.htmlspecialchars($row['bobot_kriteria']).'</td></tr>';
        }

        echo '</tbody></table>';
        echo '<div class="text-center no-print">
                <button class="btn btn-primary" onclick="window.print()">Cetak / Print</button>
                <a href="/spk-saw-supplier/kriteria" class="btn btn-secondary">Kembali</a>
            </div>';
        echo '</div></body></html>';
    }

}
