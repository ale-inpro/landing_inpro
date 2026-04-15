<?php

declare(strict_types=1);

$rootPath = dirname(__DIR__);
$appConfig = require $rootPath . '/config/app.php';
$routes = require $rootPath . '/config/routes.php';

spl_autoload_register(static function (string $class) use ($rootPath): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $rootPath . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$routePath = '/' . ltrim((string) preg_replace('#^' . preg_quote($basePath, '#') . '#', '', $uriPath), '/');
$routePath = $routePath === '//' ? '/' : $routePath;

$handler = $routes[$method][$routePath] ?? null;
if (!$handler) {
    http_response_code(404);
    echo '404 - Ruta no encontrada';
    exit;
}

[$controllerClass, $action] = $handler;
$controller = new $controllerClass($appConfig, $basePath);
$controller->{$action}();
