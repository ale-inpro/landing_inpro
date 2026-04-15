<section id="inpro" class="section container">
    <div class="about-grid reveal">
        <div class="about-visual">
            <div class="about-visual__bg"></div>
            <img
                class="about-brand__logo"
                src="<?= htmlspecialchars($baseUrl . $about['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                alt="Logo InPro"
                loading="lazy"
            />
        </div>

        <div class="about-content">
            <p class="kicker">Que hace InPro</p>
            <h2><?= htmlspecialchars($about['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="lead"><?= htmlspecialchars($about['text'], ENT_QUOTES, 'UTF-8'); ?></p>

            <div class="about-stats">
                <article>
                    <strong>+10</strong>
                    <span>Soluciones</span>
                </article>
                <article>
                    <strong>IA</strong>
                    <span>En procesos clave</span>
                </article>
                <article>
                    <strong>24/7</strong>
                    <span>Foco en operacion</span>
                </article>
            </div>
        </div>
    </div>
</section>