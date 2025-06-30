<?php
class KriteriaController extends Controller {
    public function index() {
        $model = $this->model('Kriteria');
        $data['kriteria'] = $model->getAll();
        $this->view('kriteria/index', $data);
    }

    public function tambah() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }
            $model = $this->model('Kriteria');
            $result = $model->insert($_POST['nama_kriteria'], $_POST['kode_kriteria'], $_POST['tipe_kriteria'], $_POST['bobot_kriteria']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan kriteria. Kode mungkin sudah ada atau data tidak valid.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Kriteria berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/kriteria');
            exit;
        }
        $this->view('kriteria/tambah');
    }

    public function edit($id) {
        $model = $this->model('Kriteria');
        $data['kriteria'] = $model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
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
