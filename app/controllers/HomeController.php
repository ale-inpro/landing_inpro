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
                'name' => 'VIG-IA',
                'logo' => '/assets/img/logo_vigia.webp',
                'tagline' => 'Gestión técnica con IA para empresas de inspección y mantenimiento.',
                'description' => 'VIG-IA automatiza la gestión de empresas técnicas de inspección y mantenimiento. Genera informes en segundos, gestiona personal, maquinaria y actividades desde un solo lugar.',
                'stats' => [
                    ['icon' => 'bi bi-file-earmark-text', 'value' => '-80%', 'label' => 'Tiempo en papeleo'],
                    ['icon' => 'bi bi-mouse2', 'value' => '1 click', 'label' => 'Para generar informes'],
                    ['icon' => 'bi bi-geo-alt', 'value' => '100%', 'label' => 'Trazabilidad del proyecto'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-stars',
                        'title' => 'Asistencia técnica inteligente',
                        'text' => 'Resuelve incidencias y consultas en segundos con IA entrenada para soporte técnico.',
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
                    'Detección automática de anomalías',
                    'Alertas en tiempo real para equipos',
                    'Informes de seguimiento y rendimiento',
                ],
                'tags' => ['IA aplicada', 'Monitoreo', 'Alertas'],
            ],
            [
                'id' => 'inpro-hub',
                'name' => 'INPRO HUB',
                'logo' => '/assets/img/logo_inpro_hub.webp',
                'tagline' => 'CAE, certificados, seguros y gestión administrativa en un solo lugar.',
                'description' => 'Gestión centralizada de CAE, certificados, seguros, control documental y procesos administrativos de tu empresa.',
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
                        'text' => 'Gestión de comunidades y certificados en un único punto.',
                    ],
                    [
                        'icon' => 'bi bi-patch-check',
                        'title' => 'Certificados & CAE',
                        'text' => 'Gestión integrada de certificados digitales y CAE en un solo lugar.',
                    ],
                ],
                'highlights' => [
                    'Control de procesos y tareas',
                    'Trazabilidad documental end-to-end',
                    'Escalable para distintas áreas',
                ],
                'tags' => ['Gestión', 'Integraciones', 'KPIs'],
            ],
            [
                'id' => 'actalia',
                'name' => 'ACTALIA',
                'logo' => '/assets/img/logo_actalia.webp',
                'tagline' => 'Automatiza actas para tus comunidades de propietarios.',
                'description' => 'Software que automatiza la creación de actas y documentos para comunidades de propietarios, usando IA para agilizar el proceso.',
                'stats' => [
                    ['icon' => 'bi bi-stopwatch', 'value' => '95%', 'label' => 'Tiempo ahorrado'],
                    ['icon' => 'bi bi-lightning-charge', 'value' => '5 min', 'label' => 'Para crear un acta'],
                    ['icon' => 'bi bi-shield-check', 'value' => '100%', 'label' => 'Precisión legal'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-mic',
                        'title' => 'Entrada por voz',
                        'text' => 'Dicta el contenido del acta y el sistema lo estructura automáticamente.',
                    ],
                    [
                        'icon' => 'bi bi-whatsapp',
                        'title' => 'WhatsApp Masivo',
                        'text' => 'Comunícate con todos los vecinos al instante desde un solo lugar.',
                    ],
                    [
                        'icon' => 'bi bi-shield-check',
                        'title' => 'Validación automática',
                        'text' => 'Comprueba fechas, horas y coherencia antes de generar el documento.',
                    ],
                ],
                'highlights' => [
                    'Generación automática de documentos',
                    'Asistencia en redacción y estructura',
                    'Flujos de revisión más rápidos',
                ],
                'tags' => ['Documentos', 'Automatización', 'Productividad'],
            ],
            [
                'id' => 'atalaia',
                'name' => 'ATALAIA',
                'logo' => '/assets/img/logo_atalaia.webp',
                'tagline' => 'Archivo y visor de informes, conectado con VIG-IA.',
                'description' => 'ATALAIA es donde consultas, organizas y almacenas los informes generados por VIG-IA. Centraliza la documentación técnica en un solo lugar, con acceso claro y trazabilidad.',
                'stats' => [
                    ['icon' => 'bi bi-eye', 'value' => 'Visor', 'label' => 'Informes en un clic'],
                    ['icon' => 'bi bi-archive', 'value' => 'Archivo', 'label' => 'Almacenamiento ordenado'],
                    ['icon' => 'bi bi-link-45deg', 'value' => 'VIG-IA', 'label' => 'Informes que llegan aquí'],
                ],
                'features' => [
                    [
                        'icon' => 'bi bi-folder2-open',
                        'title' => 'Consulta centralizada',
                        'text' => 'Accede a los informes generados por VIG-IA desde un único punto, sin dispersar archivos entre equipos.',
                    ],
                    [
                        'icon' => 'bi bi-hdd-stack',
                        'title' => 'Almacenamiento estructurado',
                        'text' => 'Mantén el historial de informes organizado y disponible cuando lo necesites.',
                    ],
                    [
                        'icon' => 'bi bi-shield-check',
                        'title' => 'Control de acceso',
                        'text' => 'Quién ve qué informe queda acotado a tu organización y a los permisos que definas.',
                    ],
                ],
                'highlights' => [
                    'Visor unificado de informes',
                    'Integración con VIG-IA',
                    'Archivo buscable y ordenado',
                ],
                'tags' => ['Informes', 'Visor', 'Archivo'],
            ],
        ];

        $about = [
            'logo' => '/assets/img/logo_inpro.webp',
            'title' => 'Simplificamos el trabajo diario de tu empresa',
            'text' => 'Diseñamos herramientas que reducen tiempo, errores y carga administrativa.',
        ];

        $appName = $this->config['name'] ?? 'INPRO';
        $baseUrl = $this->basePath === '' ? '' : $this->basePath;

        require dirname(__DIR__) . '/views/home.php';
    }
}