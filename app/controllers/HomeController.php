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
                'tagline' => 'Monitoreo inteligente y deteccion de incidencias en tiempo real.',
                'description' => 'Solucion enfocada en supervision operativa con alertas, trazabilidad y analitica para reaccionar mas rapido ante eventos criticos.',
                'highlights' => [
                    'Deteccion automatica de anomalias.',
                    'Alertas en tiempo real para equipos.',
                    'Informes de seguimiento y rendimiento.',
                ],
                'icon' => 'shield',
            ],
            [
                'id' => 'inpro-gestion',
                'name' => 'InPro-Gestion',
                'tagline' => 'Gestion integral y transparente para operaciones complejas.',
                'description' => 'Plataforma centralizada para procesos internos, control documental, estados de trabajo y toma de decisiones basada en datos.',
                'highlights' => [
                    'Control de procesos y tareas en un solo entorno.',
                    'Trazabilidad documental end-to-end.',
                    'Escalable para diferentes unidades de negocio.',
                ],
                'icon' => 'building',
            ],
            [
                'id' => 'actalia',
                'name' => 'Actalia',
                'tagline' => 'Automatizacion documental con IA aplicada.',
                'description' => 'Sistema para generar actas y documentos en segundos, reduciendo errores manuales y mejorando la productividad del equipo.',
                'highlights' => [
                    'Generacion automatica de documentos.',
                    'Asistencia en redaccion y estructura.',
                    'Flujos de revision mas rapidos.',
                ],
                'icon' => 'file',
            ],
            [
                'id' => 'control-empresas',
                'name' => 'Control de Empresas',
                'tagline' => 'Ecosistema tecnologico a medida para control total.',
                'description' => 'Conjunto de herramientas para supervisar indicadores clave, integraciones y operaciones transversales de manera unificada.',
                'highlights' => [
                    'Vision global de indicadores.',
                    'Integracion de sistemas existentes.',
                    'Automatizacion de reportes ejecutivos.',
                ],
                'icon' => 'chart',
            ],
        ];

        $about = [
            'title' => 'Desarrollo tecnologico con impacto real',
            'text' => 'InPro es una empresa de desarrollo tecnologico e integraciones. Creamos productos propios y soluciones a medida para optimizar procesos, mejorar eficiencia y acelerar resultados con IA.',
        ];

        $appName = $this->config['name'] ?? 'InPro';
        $baseUrl = $this->basePath === '' ? '' : $this->basePath;

        require dirname(__DIR__) . '/views/home.php';
    }
}