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
                'logo' => '/assets/img/logo-vigia.png',
                'tagline' => 'Generación inteligente de informes de la trazabilidad de tus proyectos publicos.',
                'description' => 'Del campo a reporte tecnico en segundos.',
                'stats' => [
                    ['icon' => 'bi bi-file-earmark-text', 'value' => '-80%', 'label' => 'Tiempo en papeleo'],
                    ['icon' => 'bi bi-mouse2', 'value' => '1 click', 'label' => 'Para generar informes'],
                    ['icon' => 'bi bi-geo-alt', 'value' => '100%', 'label' => 'Trazabilidad del proyecto'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-stars',
                        'title' => 'Asistencia técnica inteligente',
                        'text' => 'Resuelve incidencias y consultas en segundos gracias a un motor de IA entrenado para soporte técnico.',
                    ],
                    [
                        'icon' => 'bi bi-lightning-charge',
                        'title' => 'Automatización de tareas repetitivas',
                        'text' => 'Reduce tiempos operativos automatizando diagnósticos, respuestas y procesos internos.',
                    ],
                    [
                        'icon' => 'bi bi-shield-lock',
                        'title' => 'Integración segura y adaptable',
                        'text' => 'Se conecta con tus sistemas actuales manteniendo la seguridad y privacidad de los datos.',
                    ],
                ],
                'highlights' => [
                    'Deteccion automatica de anomalias',
                    'Alertas en tiempo real para equipos',
                    'Informes de seguimiento y rendimiento',
                ],
                'tags' => ['IA aplicada', 'Monitoreo', 'Alertas'],
            ],
            [
                'id' => 'inpro-gestion',
                'name' => 'InPro-Gestion',
                'logo' => '/assets/img/logo_inpro.png',
                'tagline' => 'Optimizacion, cumplimiento y valor.',
                'description' => 'Plataforma centralizada para procesos internos, control documental, estados de trabajo y toma de decisiones basada en datos.',
                'stats' => [
                    ['icon' => 'bi bi-gear', 'value' => 'Optimiza', 'label' => 'Operación diaria'],
                    ['icon' => 'bi bi-shield-check', 'value' => 'Cumple', 'label' => 'Normativa y procesos'],
                    ['icon' => 'bi bi-graph-up', 'value' => 'Aporta', 'label' => 'Valor medible'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-calendar-check',
                        'title' => 'Eficiencia diaria',
                        'text' => 'Simplifica la labor diaria de administración con flujos claros y controlados.',
                    ],
                    [
                        'icon' => 'bi bi-buildings',
                        'title' => 'Gestión digital',
                        'text' => 'Plataforma de comunidades y certificados para operar de forma centralizada.',
                    ],
                    [
                        'icon' => 'bi bi-patch-check',
                        'title' => 'Certificados & CAE',
                        'text' => 'Gestión integrada de certificados digitales y CAE en un solo lugar.',
                    ],
                    [
                        'icon' => 'bi bi-shield-exclamation',
                        'title' => 'Información RGPD',
                        'text' => 'Garantiza el cumplimiento normativo en productos y tratamiento de datos.',
                    ],
                    [
                        'icon' => 'bi bi-cash-coin',
                        'title' => 'Control de costes',
                        'text' => 'Soluciones para optimizar recursos y reducir costes de forma continua.',
                    ],
                    [
                        'icon' => 'bi bi-headset',
                        'title' => 'Soporte al cliente',
                        'text' => 'Asesoramiento real para acompañarte en la implantación y el uso.',
                    ],
                ],
                'highlights' => [
                    'Control de procesos y tareas',
                    'Trazabilidad documental end-to-end',
                    'Escalable para distintas areas',
                ],
                'tags' => ['Gestion', 'Integraciones', 'KPIs'],
            ],
            [
                'id' => 'actalia',
                'name' => 'Actalia',
                'logo' => '/assets/img/logo_actalia.png',
                'tagline' => 'Automatiza tus actas y documentos en segundos.',
                'description' => 'La plataforma de Inteligencia Artificial que revoluciona la gestión de comunidades de propietarios. Tu tiempo, más tuyo.',
                'stats' => [
                    ['icon' => 'bi bi-stopwatch', 'value' => '95%', 'label' => 'Tiempo ahorrado'],
                    ['icon' => 'bi bi-lightning-charge', 'value' => '5 min', 'label' => 'Para crear un acta'],
                    ['icon' => 'bi bi-shield-check', 'value' => '100%', 'label' => 'Precisión legal'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-mic',
                        'title' => 'IA Conversacional',
                        'text' => 'Crea documentos hablando naturalmente. Sin formularios, sin complicaciones.',
                    ],
                    [
                        'icon' => 'bi bi-whatsapp',
                        'title' => 'WhatsApp Masivo',
                        'text' => 'Comunícate con todos los vecinos al instante desde un solo lugar.',
                    ],
                    [
                        'icon' => 'bi bi-check2-shield',
                        'title' => 'Cero Errores',
                        'text' => 'La IA valida fechas, horas y coherencia por ti antes de generar el documento.',
                    ],
                ],
                'highlights' => [
                    'Generacion automatica de documentos',
                    'Asistencia en redaccion y estructura',
                    'Flujos de revision mas rapidos',
                ],
                'tags' => ['Documentos', 'Automatizacion', 'Productividad'],
            ],
            [
                'id' => 'control-empresas',
                'name' => 'Control de Empresas',
                'logo' => '/assets/img/logo_inpro.png',
                'tagline' => 'La solución que amplía, conecta y moderniza el software con el que trabaja tu empresa.',
                'description' => 'Conjunto de herramientas para supervisar indicadores clave, integraciones y operaciones transversales de manera unificada.',
                'stats' => [
                    ['icon' => 'bi bi-diagram-3', 'value' => '+Integración', 'label' => 'Sistemas conectados'],
                    ['icon' => 'bi bi-lightning-charge', 'value' => 'Automatiza', 'label' => 'Procesos internos'],
                    ['icon' => 'bi bi-speedometer2', 'value' => 'Visión 360°', 'label' => 'Indicadores del negocio'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-puzzle',
                        'title' => 'Integración sin fricción',
                        'text' => 'Conecta tus herramientas actuales y centraliza la información sin cambiar tu forma de trabajar.',
                    ],
                    [
                        'icon' => 'bi bi-sliders',
                        'title' => 'Automatización operativa',
                        'text' => 'Reduce tareas repetitivas con flujos automáticos, alertas y reportes configurables.',
                    ],
                    [
                        'icon' => 'bi bi-lock',
                        'title' => 'Seguridad y control',
                        'text' => 'Permisos por rol, trazabilidad y buenas prácticas para mantener tus datos protegidos.',
                    ],
                ],
                'highlights' => [
                    'Vision global de indicadores',
                    'Integracion de sistemas existentes',
                    'Automatizacion de reportes ejecutivos',
                ],
                'tags' => ['Control', 'Operaciones', 'Analitica'],
            ],
        ];

        $about = [
            'logo' => '/assets/img/logo_inpro.png',
            'title' => 'Desarrollo tecnologico con impacto real',
            'text' => 'InPro es una empresa de desarrollo tecnologico e integraciones. Creamos productos propios y soluciones a medida para optimizar procesos, mejorar eficiencia y acelerar resultados con IA.',
        ];

        $appName = $this->config['name'] ?? 'InPro';
        $baseUrl = $this->basePath === '' ? '' : $this->basePath;

        require dirname(__DIR__) . '/views/home.php';
    }
}