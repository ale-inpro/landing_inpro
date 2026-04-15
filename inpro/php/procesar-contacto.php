<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'inpro_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sql  = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Error al preparar consulta: ' . $conn->error);
}

$stmt->bind_param('sss', $nombre, $email, $mensaje);

if ($stmt->execute()) {
    header('Location: index.html?enviado=1');
    exit;
} else {
    echo 'Error al guardar el mensaje: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
