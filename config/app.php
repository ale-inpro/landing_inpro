<?php

declare(strict_types=1);

if (!function_exists('loadEnvFile')) {
    function loadEnvFile(string $path): void
    {
        if (!is_file($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '') {
                continue;
            }

            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
            }
        }
    }
}

if (!function_exists('env')) {
    function env(string $key, ?string $default = null): ?string
    {
        return $_ENV[$key] ?? $default;
    }
}

loadEnvFile(dirname(__DIR__) . '/.env');

return [
    'name' => env('APP_NAME', 'InPro'),
    'url' => env('APP_URL', 'http://localhost/landing_inpro/public'),
    'debug' => env('APP_DEBUG', 'false') === 'true',

    'db' => [
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'landing_inpro'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => env('DB_CHARSET', 'utf8mb4'),
    ],

    'mail' => [
        'resend_api_key' => env('RESEND_API_KEY', ''),
        'from' => env('MAIL_FROM', 'onboarding@resend.dev'),
        'to' => env('MAIL_TO', ''),
        'reply_to' => env('MAIL_REPLY_TO', ''),
    ],
];
