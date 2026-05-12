<section id="inicio" class="hero">
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <div class="hero-text reveal">
            <div class="hero-tag">
                <span class="hero-tag__icon" aria-hidden="true">&gt;_</span>
                <code>inpro/soluciones</code>
            </div>
            <h1>Software a medida para tu empresa.</h1>
            <p class="hero-sub">
                Desarrollo, integraciones y automatización. Con IA cuando aporta valor.
            </p>
            <a href="#contacto" class="hero-cta">
                Hablemos de tu proyecto <span aria-hidden="true">→</span>
            </a>
        </div>

        <div class="hero-visual reveal">
            <pre class="code-block" id="hero-code"><code><span class="code-line"><span class="code-comment">// Lo que hacemos, resumido</span></span>
<span class="code-line"><span class="code-keyword">const</span> inpro = {</span>
<span class="code-line">  <span class="code-comment">// nos adaptamos a cualquier stack</span></span>
<span class="code-line">  stack: [<span class="code-string">'IA'</span>, <span class="code-string">'PHP'</span>, <span class="code-string">'Python'</span>, <span class="code-string">'React'</span>, <span class="code-string">'TypeScript'</span>,</span>
<span class="code-line">    <span class="code-string">'Node'</span>, <span class="code-string">'SQL'</span>, <span class="code-string">'Docker'</span>, <span class="code-string">'REST'</span>],</span>
<span class="code-line">  <span class="code-comment">// software propio, no reventas</span></span>
<span class="code-line">  enfoque: <span class="code-string">'producto'</span>,</span>
<span class="code-line">  <span class="code-comment">// de pymes a grandes cuentas</span></span>
<span class="code-line">  clientes: <span class="code-string">'tu empresa'</span>,</span>
<span class="code-line"></span>
<span class="code-line">  <span class="code-method">build</span>(problema) {</span>
<span class="code-line">    <span class="code-keyword">return</span> solucion.queRealmente(funciona);</span>
<span class="code-line">  }</span>
<span class="code-line">};</span></code></pre>
        </div>
    </div>

    <div class="container">
        <div class="bento-grid reveal">
            <?php foreach ($projects as $i => $project): ?>
                <article class="bento-card bento-card--<?= $i + 1 ?>" >
                    <div class="bento-card__head">
                        <img
                            class="bento-logo"
                            src="<?= htmlspecialchars($baseUrl . $project['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                            alt="Logo <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>"
                            loading="lazy"
                        />
                        <h3><?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    </div>
                    <p><?= htmlspecialchars($project['tagline'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <button
                        type="button"
                        class="bento-link js-open-project"
                        data-project="<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
                    >
                        Explorar <span aria-hidden="true">→</span>
                    </button>
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

                <div class="project-modal__scroll">
                <div class="modal-brand">
                    <img
                        class="modal-brand__logo"
                        src="<?= htmlspecialchars($baseUrl . $project['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Logo <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>"
                        loading="lazy"
                    />
                    <div>
                        <span class="kicker">Proyecto</span>
                        <h3 id="title-<?= htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                    </div>
                </div>

                <p class="modal-description"><?= htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php if (in_array(($project['id'] ?? ''), ['actalia', 'vigia', 'inpro-hub', 'atalaia'], true)): ?>
                    <div class="modal-stats">
                        <?php foreach (($project['stats'] ?? []) as $stat): ?>
                            <div class="modal-stat">
                                <div class="modal-stat__icon">
                                    <i class="<?= htmlspecialchars($stat['icon'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                                </div>
                                <div class="modal-stat__value"><?= htmlspecialchars($stat['value'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="modal-stat__label"><?= htmlspecialchars($stat['label'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <h4 class="modal-section-title">Características</h4>

                    <div class="modal-features">
                        <?php foreach (($project['features'] ?? []) as $feature): ?>
                            <article class="modal-feature">
                                <div class="modal-feature__icon">
                                    <i class="<?= htmlspecialchars($feature['icon'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                                </div>
                                <h5><?= htmlspecialchars($feature['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p><?= htmlspecialchars($feature['text'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="modal-tags">
                        <?php foreach ($project['tags'] as $tag): ?>
                            <span><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <ul class="modal-list">
                        <?php foreach ($project['highlights'] as $item): ?>
                            <li><i class="bi bi-check2-circle" aria-hidden="true"></i> <?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</div>
