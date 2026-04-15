<?php

declare(strict_types=1);

namespace App\Services;

final class ResendMailer
{
    public function __construct(private readonly array $config)
    {
    }

    public function sendContactMail(string $name, string $email, string $message): bool
    {
        $apiKey = $this->config['resend_api_key'] ?? '';
        $from = $this->config['from'] ?? 'onboarding@resend.dev';
        $to = $this->config['to'] ?? '';
        $replyTo = $this->config['reply_to'] ?? '';

        if ($apiKey === '' || $to === '') {
            return false;
        }

        $html = sprintf(
            '<h2>Nuevo contacto desde la landing</h2><p><strong>Nombre:</strong> %s</p><p><strong>Email:</strong> %s</p><p><strong>Mensaje:</strong><br>%s</p>',
            htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'))
        );

        $payload = [
            'from' => $from,
            'to' => [$to],
            'subject' => 'Nuevo lead desde landing InPro',
            'html' => $html,
        ];

        if ($replyTo !== '') {
            $payload['reply_to'] = $replyTo;
        }

        $ch = curl_init('https://api.resend.com/emails');
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_TIMEOUT => 20,
        ]);

        curl_exec($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $statusCode >= 200 && $statusCode < 300;
    }
}
