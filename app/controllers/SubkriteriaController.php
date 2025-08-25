<?php
class SubkriteriaController extends Controller {
    public function index() {
        $model_kriteria = $this->model('Kriteria');
        $model_subkriteria = $this->model('Subkriteria');
        $data['kriteria'] = $model_kriteria->getAll();
        $data['subkriteria'] = $model_subkriteria->getAll();
        $this->view('subkriteria/index', $data);
    }

    public function tambah($id) {
        $model = $this->model('Kriteria');
        $data['kriteria'] = $model->getById($id);
        if (!$data['kriteria']) {
            $_SESSION['message'] = "Kriteria tidak ditemukan.";
            $_SESSION['alert-type'] = "danger";
            header('Location: /spk-saw-supplier/subkriteria');
            exit;
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['login_error'] = "CSRF token tidak valid! Harap login kembali.";
                header('Location: /spk-saw-supplier/auth/login');
                exit;
            }
            $model = $this->model('Subkriteria');
            $result = $model->insert($_POST['nama_subkriteria'], $_POST['nilai_subkriteria'], $id);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan subkriteria.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Subkriteria berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/subkriteria');
            exit;
        }
        $this->view('subkriteria/tambah', $data);
    }

    public function edit($id) {
        $model_subkriteria = $this->model('Subkriteria');
        $model_kriteria = $this->model('Kriteria');
        $data['subkriteria'] = $model_subkriteria->getById($id);
        $data['kriteria'] = $model_kriteria->getById($data['subkriteria']['id_kriteria']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['login_error'] = "CSRF token tidak valid! Harap login kembali.";
                header('Location: /spk-saw-supplier/auth/login');
                exit;
            }
            $result = $model_subkriteria->update($id, $_POST['nama_subkriteria'], $_POST['nilai_subkriteria']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan subkriteria.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Subkriteria berhasil diedit.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /spk-saw-supplier/subkriteria');
            exit;
        }

        $this->view('subkriteria/edit', $data);
    }

    public function hapus($id) {
        $model = $this->model('Subkriteria');
        $model->delete($id);
        header('Location: /spk-saw-supplier/subkriteria');
    }

}
