<?php

declare(strict_types=1);

ini_set('display_errors', '0');
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Acceso no permitido.');
}

$nombre  = trim($_POST['nombre']  ?? '');
$email   = trim($_POST['email']   ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre === '' || $email === '' || $mensaje === '') {
    die('Todos los campos son obligatorios.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('El correo no es válido.');
}

$envPath = dirname(__DIR__, 2) . '/.env';
$dbConfig = ['host' => 'localhost', 'user' => 'root', 'pass' => '', 'db' => 'inpro_db'];

if (is_file($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    $env = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
    $dbConfig = [
        'host' => $env['DB_HOST'] ?? $dbConfig['host'],
        'user' => $env['DB_USERNAME'] ?? $dbConfig['user'],
        'pass' => $env['DB_PASSWORD'] ?? $dbConfig['pass'],
        'db'   => $env['DB_DATABASE'] ?? $dbConfig['db'],
    ];
}

$conn = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['db']);

if ($conn->connect_error) {
    die('Error de conexión. Inténtelo más tarde.');
}

$sql  = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Error interno. Inténtelo más tarde.');
}

$stmt->bind_param('sss', $nombre, $email, $mensaje);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header('Location: index.html?enviado=1');
    exit;
}

$stmt->close();
$conn->close();
die('No se pudo guardar el mensaje. Inténtelo más tarde.');
