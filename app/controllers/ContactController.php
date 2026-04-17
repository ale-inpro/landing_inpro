<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ResendMailer;
use PDO;
use PDOException;

final class ContactController
{
    public function __construct(
        private readonly array $config,
        private readonly string $basePath
    ) {
    }

    public function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $subject = trim($_POST['subject'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($subject === '' || $name === '' || $email === '' || $phone === '' || $message === '') {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'Todos los campos son obligatorios.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'El email no es valido.']);
            return;
        }

        // 1) Guardar en BD
        try {
            $this->storeInDatabase($subject, $name, $email, $phone, $message);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['ok' => false, 'message' => 'No se pudo guardar el mensaje en base de datos.']);
            return;
        }
        $messageForEmail =
              "Asunto: {$subject}\n" .
              "Nombre: {$name}\n" .
              "Teléfono: {$phone}\n" .
              "Email: {$email}\n\n" .
              "Mensaje: {$message}";

       // 2) Enviar email con Resend
       try {
            $mailer = new ResendMailer($this->config['mail'] ?? []);
            $mailResult = $mailer->sendContactMail($name, $email, $messageForEmail, $subject, $phone);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'message' => 'Error interno al enviar email (Resend).',
            ]);
            return;
        }
        
        if (!$mailResult['ok']) {
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'message' => 'Mensaje guardado, pero fallo Resend.',
                'debug' => $mailResult,
            ]);
            return;
        }

        echo json_encode(['ok' => true, 'message' => 'Mensaje guardado y enviado correctamente.']);
    }

    private function storeInDatabase(string $subject, string $name, string $email, string $phone, string $message): void
    {
        $db = $this->config['db'] ?? [];

        $host = $db['host'] ?? '127.0.0.1';
        $port = $db['port'] ?? '3306';
        $database = $db['database'] ?? '';
        $username = $db['username'] ?? '';
        $password = $db['password'] ?? '';
        $charset = $db['charset'] ?? 'utf8mb4';

        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $database, $charset);

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $sql = 'INSERT INTO contact_messages (subject, name, email, phone, message) VALUES (:subject, :name, :email, :phone, :message)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':subject' => $subject,
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':message' => $message,
        ]);
    }
}