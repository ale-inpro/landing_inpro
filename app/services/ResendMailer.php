<?php

declare(strict_types=1);

namespace App\Services;

final class ResendMailer
{
    public function __construct(private readonly array $config)
    {
    }

    public function sendContactMail(
        string $name,
        string $email,
        string $message,
        string $subjectFromForm = '',
        string $phone = ''
    ): array {
        if (!function_exists('curl_init')) {
            return ['ok' => false, 'error' => 'cURL no disponible'];
        }

        $apiKey = $this->config['resend_api_key'] ?? '';
        $from = $this->config['from'] ?? 'onboarding@resend.dev';
        $to = $this->config['to'] ?? '';
        $replyTo = $this->config['reply_to'] ?? '';

        if ($apiKey === '' || $to === '') {
            return ['ok' => false, 'error' => 'Falta RESEND_API_KEY o MAIL_TO'];
        }

        $subjectFromForm = trim($subjectFromForm);
        $subject = $subjectFromForm !== ''
            ? sprintf('[InPro] %s', $subjectFromForm)
            : sprintf('[InPro] Nueva solicitud de contacto - %s', $name);

        $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $safePhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
        $safeSubject = htmlspecialchars($subjectFromForm, ENT_QUOTES, 'UTF-8');
        $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

        $html = <<<HTML
        <div style="font-family:Segoe UI,Arial,sans-serif;background:#0b1220;padding:24px;color:#eaf2ff;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:680px;margin:0 auto;background:#111a2d;border:1px solid #2a3d63;border-radius:12px;overflow:hidden;">
            <tr>
            <td style="padding:18px 20px;border-bottom:1px solid #233758;background:linear-gradient(90deg,#12203a,#152748);">
                <h1 style="margin:0;font-size:18px;color:#ffffff;">Nueva solicitud de contacto</h1>
                <p style="margin:6px 0 0;color:#9fb3d1;font-size:13px;">Landing InPro</p>
            </td>
            </tr>
            <tr>
            <td style="padding:20px;">
                <p style="margin:0 0 12px;color:#cfe0ff;"><strong>Asunto:</strong> {$safeSubject}</p>
                <p style="margin:0 0 12px;color:#cfe0ff;"><strong>Nombre:</strong> {$safeName}</p>
                <p style="margin:0 0 12px;color:#cfe0ff;"><strong>Teléfono:</strong> {$safePhone}</p>
                <p style="margin:0 0 12px;color:#cfe0ff;"><strong>Email:</strong> {$safeEmail}</p>
                <p style="margin:0 0 8px;color:#cfe0ff;"><strong>Mensaje:</strong></p>
                <div style="padding:14px;border:1px solid #2e4a79;border-radius:10px;background:#0b1426;color:#e7f1ff;line-height:1.55;">
                {$safeMessage}
                </div>
            </td>
            </tr>
            <tr>
            <td style="padding:14px 20px;border-top:1px solid #233758;color:#8ea5c8;font-size:12px;">
                Este correo se envio automaticamente desde el formulario de contacto de InPro.
            </td>
            </tr>
        </table>
        </div>
        HTML;

        $text = "InPro - Nueva solicitud de contacto\n\n"
            . "Asunto: {$subjectFromForm}\n"
            . "Nombre: {$name}\n"
            . "Teléfono: {$phone}\n"
            . "Email: {$email}\n\n"
            . "Mensaje:\n{$message}\n";

        $payload = [
            'from' => $from,
            'to' => [$to],
            'subject' => $subject,
            'html' => $html,
            'text' => $text,
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

        $responseBody = curl_exec($ch);
        $curlError = curl_error($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($responseBody === false) {
            return ['ok' => false, 'error' => 'cURL error: ' . $curlError, 'status' => $statusCode];
        }

        if ($statusCode < 200 || $statusCode >= 300) {
            return ['ok' => false, 'error' => 'Resend no OK', 'status' => $statusCode, 'response' => $responseBody];
        }

        return ['ok' => true, 'status' => $statusCode, 'response' => $responseBody];
    }
}
