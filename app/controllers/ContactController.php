<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ResendMailer;
use PDO;
use PDOException;

final class ContactController
{
    private const MAX_SUBJECT = 150;
    private const MAX_NAME = 100;
    private const MAX_EMAIL = 254;
    private const MAX_PHONE = 20;
    private const MAX_MESSAGE = 3000;
    private const RATE_LIMIT_WINDOW = 300; // 5 minutes
    private const RATE_LIMIT_MAX = 3;

    public function __construct(
        private readonly array $config,
        private readonly string $basePath
    ) {
    }

    public function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        // CSRF verification
        $token = $_POST['_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            echo json_encode(['ok' => false, 'message' => 'Token de seguridad inválido. Recarga la página.']);
            return;
        }

        // Honeypot: if filled, it's a bot
        if (!empty($_POST['website'])) {
            echo json_encode(['ok' => true, 'message' => 'Mensaje guardado y enviado correctamente.']);
            return;
        }

        // Rate limiting via session
        $now = time();
        $attempts = $_SESSION['contact_attempts'] ?? [];
        $attempts = array_filter($attempts, fn(int $t) => ($now - $t) < self::RATE_LIMIT_WINDOW);
        if (count($attempts) >= self::RATE_LIMIT_MAX) {
            http_response_code(429);
            echo json_encode(['ok' => false, 'message' => 'Demasiados envíos. Inténtalo de nuevo en unos minutos.']);
            return;
        }

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

        // Length limits
        if (mb_strlen($subject) > self::MAX_SUBJECT || mb_strlen($name) > self::MAX_NAME
            || mb_strlen($email) > self::MAX_EMAIL || mb_strlen($phone) > self::MAX_PHONE
            || mb_strlen($message) > self::MAX_MESSAGE) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'Uno o más campos exceden la longitud permitida.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'El email no es válido.']);
            return;
        }

        if (!preg_match('/^[+\d\s\-().]{6,20}$/', $phone)) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'El teléfono no tiene un formato válido.']);
            return;
        }

        // Sanitize subject against header injection
        $subject = str_replace(["\r", "\n", "\0"], '', $subject);

        // Record attempt for rate limiting
        $attempts[] = $now;
        $_SESSION['contact_attempts'] = array_values($attempts);

        try {
            $this->storeInDatabase($subject, $name, $email, $phone, $message);
        } catch (PDOException $e) {
            error_log('ContactController DB error: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'message' => 'No se pudo guardar el mensaje en base de datos.',
                'newToken' => $_SESSION['csrf_token'],
            ]);
            return;
        }

        $messageForEmail =
              "Asunto: {$subject}\n" .
              "Nombre: {$name}\n" .
              "Teléfono: {$phone}\n" .
              "Email: {$email}\n\n" .
              "Mensaje: {$message}";

        try {
            $mailer = new ResendMailer($this->config['mail'] ?? []);
            $mailResult = $mailer->sendContactMail($name, $email, $messageForEmail, $subject, $phone);
        } catch (\Throwable $e) {
            error_log('ContactController mail error: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'message' => 'Error interno al enviar email (Resend).',
                'newToken' => $_SESSION['csrf_token'],
            ]);
            return;
        }

        if (!$mailResult['ok']) {
            error_log('ContactController Resend failed: ' . json_encode($mailResult));
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'message' => 'Mensaje guardado, pero hubo un error al enviar la notificación por email.',
                'newToken' => $_SESSION['csrf_token'],
            ]);
            return;
        }

        // Regenerate CSRF token only after full success
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        echo json_encode([
            'ok' => true,
            'message' => 'Mensaje guardado y enviado correctamente.',
            'newToken' => $_SESSION['csrf_token'],
        ]);
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