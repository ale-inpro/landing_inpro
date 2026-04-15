<section id="inicio" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-neon"></div>

    <div class="container hero-content">
        <div class="hero-intro">
            <p class="kicker">Tecnologia e integraciones para empresas</p>
            <h1>Construimos soluciones robustas para operaciones reales.</h1>
            <p>
                InPro combina desarrollo, automatizacion e inteligencia artificial para transformar procesos complejos
                en flujos claros, medibles y escalables.
            </p>
        </div>

        <div class="hero-cards">
            <?php foreach ($projects as $project): ?>
                <article class="project-card">
                    <h3><?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?= htmlspecialchars($project['tagline'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <button
                        type="button"
                        class="card-link js-open-project"
                        data-project="<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
                    >
                        Ver proyecto
                    </button>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="project-modals" aria-hidden="true">
    <?php foreach ($projects as $project): ?>
        <section
            class="project-modal"
            data-modal="<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
            role="dialog"
            aria-modal="true"
            aria-labelledby="title-<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
        >
            <div class="project-modal__backdrop js-close-modal"></div>
            <div class="project-modal__panel">
                <button type="button" class="project-modal__close js-close-modal" aria-label="Cerrar modal">×</button>
                <p class="kicker">Proyecto InPro</p>
                <h3 id="title-<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                <p><?= htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <ul>
                    <?php foreach ($project['highlights'] as $item): ?>
                        <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endforeach; ?>
</div>