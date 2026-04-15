<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ResendMailer;

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

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'Todos los campos son obligatorios.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            echo json_encode(['ok' => false, 'message' => 'El email no es valido.']);
            return;
        }

        $mailer = new ResendMailer($this->config['mail'] ?? []);
        $sent = $mailer->sendContactMail($name, $email, $message);

        if (!$sent) {
            http_response_code(500);
            echo json_encode(['ok' => false, 'message' => 'No se pudo enviar el mensaje.']);
            return;
        }

        echo json_encode(['ok' => true, 'message' => 'Mensaje enviado correctamente.']);
    }
}
