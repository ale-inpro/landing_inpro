<?php

declare(strict_types=1);

return [
    'GET' => [
        '/' => ['App\\Controllers\\HomeController', 'index'],
    ],
    'POST' => [
        '/contact' => ['App\\Controllers\\ContactController', 'store'],
    ],
];
