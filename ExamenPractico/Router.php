<?php
class Router {
    public static function route($uri) {
        switch ($uri) {
            case '/login':
                $controller = new AuthController();
                $controller->login();
                break;
            default:
                include 'views/login.php';
                break;
        }
    }
}