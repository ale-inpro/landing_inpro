<?php

declare(strict_types=1);

namespace App\Controllers;

final class HomeController
{
    public function __construct(
        private readonly array $config,
        private readonly string $basePath
    ) {
    }

    public function index(): void
    {
        $projects = [
            [
                'id' => 'vigia',
                'name' => 'Vig-IA',
                'tagline' => 'Supervision inteligente y deteccion de incidencias en tiempo real.',
                'description' => 'Plataforma para monitoreo inteligente, alertas operativas y trazabilidad de incidencias en entornos de trabajo.',
                'highlights' => [
                    'Deteccion automatica de eventos criticos.',
                    'Panel central de seguimiento en tiempo real.',
                    'Reportes y evidencias para toma de decisiones.',
                ],
            ],
            [
                'id' => 'inpro-gestion',
                'name' => 'InPro-Gestion',
                'tagline' => 'Gestion centralizada para operaciones, procesos y trazabilidad.',
                'description' => 'Suite para unificar la gestion diaria: operaciones, documentos y control de flujos entre equipos.',
                'highlights' => [
                    'Centralizacion de procesos en una sola plataforma.',
                    'Control documental y estados de tareas.',
                    'Escalable para distintos tipos de organizacion.',
                ],
            ],
            [
                'id' => 'actalia',
                'name' => 'Actalia',
                'tagline' => 'Automatizacion documental y flujos asistidos por IA.',
                'description' => 'Solucion para generar y estructurar documentos automaticamente, reduciendo tiempo operativo y errores.',
                'highlights' => [
                    'Generacion automatica de actas y documentos.',
                    'Asistencia con IA para redaccion y estructura.',
                    'Integracion con flujos internos existentes.',
                ],
            ],
        ];

        $appName = $this->config['name'] ?? 'InPro';
        $baseUrl = $this->basePath === '' ? '' : $this->basePath;
        require dirname(__DIR__) . '/views/home.php';
    }
}
