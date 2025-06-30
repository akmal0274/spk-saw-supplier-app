<?php
class SupplierController extends Controller {
    public function index() {
        $model = $this->model('Supplier');
        $data['supplier'] = $model->getAll();
        $this->view('supplier/index', $data);
    }

    public function tambah() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }
            $model = $this->model('Supplier');
            $result = $model->insert($_POST['nama_supplier']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan supplier.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Supplier berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/supplier');
            exit;
        }
        $this->view('supplier/tambah');
    }

    public function edit($id) {
        $model = $this->model('Supplier');
        $data['supplier'] = $model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }
            $result = $model->update($id, $_POST['nama_supplier']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal mengedit supplier.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Supplier berhasil diedit.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/supplier');
            exit;
        }

        $this->view('supplier/edit', $data);
    }

    public function hapus($id) {
        $model = $this->model('Supplier');
        $model->delete($id);
        header('Location: /spk-saw-supplier/supplier');
    }

    public function cetak() {
        $model = $this->model('Supplier');
        $supplier = $model->getAll();

        echo '<html><head><title>Cetak</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>@media print { .no-print { display: none; } }</style>
            </head><body>';
        echo '<div class="container mt-4">';
        echo '<h3 class="text-center mb-4">Laporan Data Supplier</h3>';
        echo '<table class="table table-bordered"><thead><tr>
                <th>Nama</th>
            </tr></thead><tbody>';

        foreach ($supplier as $row) {
            echo '<tr>
                    <td>'.htmlspecialchars($row['nama_supplier']).'</td></tr>';
        }

        echo '</tbody></table>';
        echo '<div class="text-center no-print">
                <button class="btn btn-primary" onclick="window.print()">Cetak / Print</button>
                <a href="/spk-saw-supplier/supplier" class="btn btn-secondary">Kembali</a>
            </div>';
        echo '</div></body></html>';
    }

}
