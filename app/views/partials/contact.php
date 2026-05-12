<section id="contacto" class="section section-dark">
    <div class="container contact-wrap">
        <div class="contact-panel reveal">
            <p class="kicker">Contacto</p>
            <h2>Cuéntanos tu proyecto</h2>
            <p>Te respondemos por email con una primera propuesta de enfoque técnico y funcional.</p>

            <div class="contact-highlights">
                <span><i class="bi bi-lightning-charge" aria-hidden="true"></i> Respuesta rápida</span>
                <span><i class="bi bi-shield-check" aria-hidden="true"></i> Enfoque profesional</span>
                <span><i class="bi bi-diagram-2" aria-hidden="true"></i> Solución a medida</span>
            </div>
        </div>

        <form id="contact-form" class="contact-form reveal" action="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8'); ?>/contact" method="POST" novalidate>
            <input type="hidden" name="_token" value="<?= $csrfToken; ?>">
            <div class="hp-field" aria-hidden="true">
                <label for="website">No rellenar</label>
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
            </div>
            <label>
                Asunto
                <input type="text" name="subject" required maxlength="150" autocomplete="off">
            </label>
            <label>
                Nombre
                <input type="text" name="name" required maxlength="100" autocomplete="name">
            </label>
            <label>
                Teléfono
                <input type="tel" name="phone" required maxlength="20" pattern="[+\d\s\-().]{6,20}" autocomplete="tel">
            </label>
            <label>
                Email
                <input type="email" name="email" required maxlength="254" autocomplete="email">
            </label>
            <label>
                Mensaje
                <textarea name="message" rows="4" required maxlength="3000"></textarea>
            </label>
            <button type="submit">Enviar mensaje</button>
            <p id="contact-feedback" class="contact-feedback" role="status" aria-live="polite"></p>
        </form>
    </div>
</section>