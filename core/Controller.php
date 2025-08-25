<?php
class Controller {
    public function __construct() {
        if (isset($_GET['url']) && strpos($_GET['url'], 'logout') !== false) {
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $current = get_class($this);

        if (!isset($_SESSION['user'])) {
            if ($current !== 'AuthController') {
                header('Location: /spk-saw-supplier/auth/login');
                exit;
            }
        } else {
            if ($current === 'AuthController') {
                header('Location: /spk-saw-supplier/dashboard');
                exit;
            }
        }
    }

    public function model($model) {
        require_once __DIR__ . '/../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = []) {
        extract($data);
        ob_start();
        require_once __DIR__ . '/../app/views/' . $view . '.php';
        $content = ob_get_clean();
        $authViews = ['auth/login', 'auth/register'];
        if (!in_array($view, $authViews)) {
            require_once __DIR__ . '/../app/views/layout.php';
        } else {
            echo $content;
        }
            
    }
}
