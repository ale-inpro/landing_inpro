<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?> | Innovacion tecnologica</title>
    <meta name="description" content="InPro desarrolla soluciones tecnologicas e integraciones con foco en eficiencia e IA.">
    <link rel="icon" type="image/png" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $baseUrl; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= $baseUrl; ?>/assets/css/responsive.css">
</head>
<body>
<?php require __DIR__ . '/partials/navbar.php'; ?>

<main>
    <?php require __DIR__ . '/partials/hero.php'; ?>
    <?php require __DIR__ . '/partials/about.php'; ?>
    <?php require __DIR__ . '/partials/services.php'; ?>
    <?php require __DIR__ . '/partials/contact.php'; ?>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
<script src="<?= $baseUrl; ?>/assets/js/main.js"></script>
</body>
</html>