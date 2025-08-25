<?php

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('User')->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
                header('Location: /spk-saw-supplier/dashboard');
                exit;
            } else {
                $_SESSION['login_error'] = "Username atau password salah.";
            }
        }

        $this->view('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->model('User')->create($username, $email, $password);
            $_SESSION['success'] = "Pendaftaran berhasil. Silakan login.";
            header('Location: /spk-saw-supplier/auth/login');
            exit;
        }

        $this->view('auth/register');
    }

    public function logout() {
        session_destroy();
        session_unset();
        header('Location: /spk-saw-supplier/auth/login');
    }
}
