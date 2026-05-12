<?php
declare(strict_types=1);
$safeBase = htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8');
$safeName = htmlspecialchars($appName, ENT_QUOTES, 'UTF-8');
$siteUrl = htmlspecialchars($this->config['url'] ?? '', ENT_QUOTES, 'UTF-8');
$csrfToken = htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8');

$jsonLd = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'INPRO',
    'url' => $this->config['url'] ?? '',
    'logo' => ($baseUrl ?: '') . '/assets/img/logo_inpro.webp',
    'description' => 'Soluciones digitales avanzadas para empresas. Tecnología, integración e IA.',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Calle Lasaga Larreta, nº7, bajo',
        'addressLocality' => 'Torrelavega',
        'addressRegion' => 'Cantabria',
        'postalCode' => '39300',
        'addressCountry' => 'ES',
    ],
    'telephone' => '+34658286556',
    'email' => 'info@inpro.es',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $safeName; ?> | Inteligencia Profesional</title>
    <meta name="description" content="INPRO desarrolla soluciones tecnológicas e integraciones con foco en eficiencia e IA.">
    <link rel="canonical" href="<?= $siteUrl; ?>/">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="INPRO">
    <meta property="og:title" content="<?= $safeName; ?> | Inteligencia Profesional">
    <meta property="og:description" content="Soluciones digitales avanzadas para empresas que quieren evolucionar. Tecnología, integración e IA.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $siteUrl; ?>/">
    <meta property="og:image" content="<?= $safeBase; ?>/assets/img/og-image.webp">
    <link rel="icon" type="image/webp" href="<?= $safeBase; ?>/assets/img/favicon.webp" sizes="32x32">
    <link rel="apple-touch-icon" href="<?= $safeBase; ?>/assets/img/favicon.webp">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $safeBase; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= $safeBase; ?>/assets/css/responsive.css">
    <script type="application/ld+json"><?= $jsonLd; ?></script>
</head>
<body>
<a href="#main-content" class="skip-link">Saltar al contenido</a>
<?php require __DIR__ . '/partials/navbar.php'; ?>

<main id="main-content">
    <?php require __DIR__ . '/partials/hero.php'; ?>
    <?php require __DIR__ . '/partials/about.php'; ?>
    <?php require __DIR__ . '/partials/services.php'; ?>
    <?php require __DIR__ . '/partials/contact.php'; ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
<script src="<?= $safeBase; ?>/assets/js/main.js"></script>
</body>
</html>