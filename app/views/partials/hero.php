<section id="inicio" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-neon"></div>

    <div class="container hero-content">
        <div class="hero-intro reveal">
            <p class="kicker">Tecnologia + IA + Integraciones</p>
            <h1>Soluciones digitales avanzadas para empresas que quieren evolucionar.</h1>
            <p>
                En InPro transformamos procesos complejos en operaciones claras, medibles y escalables.
                Innovacion aplicada para resultados reales.
            </p>
            <div class="hero-badges">
                <span><i class="bi bi-cpu"></i> IA aplicada</span>
                <span><i class="bi bi-diagram-3"></i> Integraciones</span>
                <span><i class="bi bi-bar-chart-line"></i> Optimizacion</span>
            </div>
        </div>

        <div class="hero-cards">
            <?php foreach ($projects as $project): ?>
                <article class="project-card reveal">
                    <div class="project-card__top">
                        <img
                            class="project-logo"
                            src="<?= htmlspecialchars($baseUrl . $project['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="Logo <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>"
                            loading="lazy"
                        />
                    </div>

                    <h3><?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?= htmlspecialchars($project['tagline'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <a
                        href="#"
                        class="card-link js-open-project"
                        data-project="<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
                    >
                        Ver mas <span class="card-link__arrow" aria-hidden="true">→</span>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div id="project-modals" class="project-modals" aria-hidden="true">
    <?php foreach ($projects as $project): ?>
        <section
            class="project-modal"
            data-modal="<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
            role="dialog"
            aria-modal="true"
            aria-labelledby="title-<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
        >
            <div class="project-modal__backdrop js-close-modal"></div>
            <div class="project-modal__panel" tabindex="-1">
                <button type="button" class="project-modal__close js-close-modal" aria-label="Cerrar modal">×</button>

                <div class="modal-brand">
                    <img
                        class="modal-brand__logo"
                        src="<?= htmlspecialchars($baseUrl . $project['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Logo <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>"
                        loading="lazy"
                    />
                    <div>
                        <span class="kicker">Proyecto destacado</span>
                        <h3 id="title-<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                    </div>
                </div>

                <p class="modal-description"><?= htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>

                <div class="modal-tags">
                    <?php foreach ($project['tags'] as $tag): ?>
                        <span><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endforeach; ?>
                </div>

                <ul class="modal-list">
                    <?php foreach ($project['highlights'] as $item): ?>
                        <li><i class="bi bi-check2-circle"></i> <?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endforeach; ?>
</div>