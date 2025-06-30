<?php
class App {
    public static $currentController = '';
    public static $currentMethod = '';

    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Cek controller
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';
            if (file_exists($controllerPath)) {
                $this->controller = $controllerName;
                unset($url[0]);
                self::$currentController = str_replace('Controller', '', $this->controller);
            }
        }

        require_once  __DIR__ . '/../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Cek method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
                self::$currentMethod = $this->method;
            }
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        // Panggil controller & method & params
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
