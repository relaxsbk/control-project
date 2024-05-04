<?php

namespace core\controllers;

class Router
{
    public static array $routes = [];

    public static function get($url, $namePage): void
    {
     self::$routes[] = [
         "url" => $url,
         "namePage" => $namePage,
     ];
    }

    public static function post($url, $class, $method): void
    {
        self::$routes[] = [
            "url" => $url,
            "class" => $class,
            "method" => $method,
        ];
    }

    public static function action()
    {
        $path = $_GET['path'] ?? '';

        foreach (self::$routes as $route) {
            if ($route['url'] === '/' . $path) {
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    switch ($route['url']) {
                        case '/addProduct':
                            $method = $route['method'];
                            $class = new $route['class'];
                            $class->$method();
                            break;
                        case '/updateProduct':
                            $method = $route['method'];
                            $class = new $route['class'];
                            $class->$method();
                            break;
                        case '/deleteProduct':
                            $method = $route['method'];
                            $class = new $route['class'];
                            $class->$method();
                            break;
                    }
                } else {
                    require_once __DIR__ . '/../../../resources/views/pages/' . $route['namePage'] . '.view.php';
                    die;
                }
            }
        }
        require_once __DIR__ . '/../../../resources/views/error/404.error.php';
        die;
    }

}