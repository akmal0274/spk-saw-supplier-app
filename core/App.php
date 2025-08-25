<?php
class App {
    public static $currentController = '';
    public static $currentMethod = '';

    protected $controllerName = 'AuthController';
    protected $controller;
    protected $method = 'login';
    protected $params = [];

    public function __construct() {
        session_start();

        $url = $this->parseURL();

        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerPath)) {
                $this->controllerName = $controllerName;
                unset($url[0]);
            } else {
                // fallback ke AuthController
                $this->controllerName = 'AuthController';
            }
        }

        self::$currentController = $this->controllerName;

        require_once __DIR__ . '/../app/controllers/' . $this->controllerName . '.php';
        $this->controller = new $this->controllerName;

        // Cek method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } else {
            if ($this->controllerName === 'AuthController') {
                $this->method = 'login';
            } else {
                $this->method = 'index';
            }
        }

        self::$currentMethod = $this->method;

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
