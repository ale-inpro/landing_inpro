<section id="contacto" class="section section-dark">
    <div class="container contact-wrap">
        <div class="contact-panel reveal">
            <p class="kicker">Contacto</p>
            <h2>¿Tienes un proyecto en mente?</h2>
            <p>Escríbenos y te respondemos con una propuesta técnica adaptada a tu caso.</p>
        </div>

        <form id="contact-form" class="contact-form reveal" action="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/contact" method="POST" novalidate>
            <input type="hidden" name="_token" value="<?= $csrfToken; ?>">
            <div class="hp-field" aria-hidden="true">
                <label for="website">No rellenar</label>
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
            </div>
            <div class="form-row">
                <label>
                    Nombre
                    <input type="text" name="name" required maxlength="100" autocomplete="name" placeholder="Tu nombre">
                </label>
                <label>
                    Email
                    <input type="email" name="email" required maxlength="254" autocomplete="email" placeholder="tu@email.com">
                </label>
            </div>
            <div class="form-row">
                <label>
                    Teléfono
                    <input type="tel" name="phone" required maxlength="20" pattern="[+\d\s\-().]{6,20}" autocomplete="tel" placeholder="+34 600 000 000">
                </label>
                <label>
                    Asunto
                    <input type="text" name="subject" required maxlength="150" autocomplete="off" placeholder="¿En qué podemos ayudarte?">
                </label>
            </div>
            <label>
                Mensaje
                <textarea name="message" rows="4" required maxlength="3000" placeholder="Cuéntanos los detalles de tu proyecto..."></textarea>
            </label>
            <button type="submit">Enviar mensaje <span aria-hidden="true">→</span></button>
            <p id="contact-feedback" class="contact-feedback" role="status" aria-live="polite"></p>
        </form>
    </div>
</section>
