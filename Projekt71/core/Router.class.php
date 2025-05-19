<?php

class Router {
    private $routes = [];

    public function addRoute($action, $controller, $method, $roles = []) {
        $this->routes[$action] = [
            'controller' => $controller,
            'method' => $method,
            'roles' => $roles
        ];
    }

    public function go() {
        $action = $_GET['action'] ?? 'login';

        if (!isset($this->routes[$action])) {
            die('Brak takiej akcji: ' . htmlspecialchars($action));
        }

        $route = $this->routes[$action];

        if (!$this->checkRoles($route['roles'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $controller = new $route['controller']();
        $method = $route['method'];
        $controller->$method();
    }

    private function checkRoles($roles) {
        if (empty($roles)) return true;
        $userRole = getFromSession('role');
        return in_array($userRole, $roles);
    }
}
