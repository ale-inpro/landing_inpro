<section id="contacto" class="section section-dark">
    <div class="container contact-wrap">
        <div>
            <p class="kicker">Contacto</p>
            <h2>Cuéntanos tu proyecto</h2>
            <p>Te respondemos por email con una primera propuesta de enfoque tecnico y funcional.</p>
        </div>
        <form id="contact-form" class="contact-form" action="<?= $baseUrl; ?>/contact" method="POST">
            <label>
                Nombre
                <input type="text" name="name" required>
            </label>
            <label>
                Email
                <input type="email" name="email" required>
            </label>
            <label>
                Mensaje
                <textarea name="message" rows="4" required></textarea>
            </label>
            <button type="submit">Enviar mensaje</button>
            <p id="contact-feedback" class="contact-feedback" role="status" aria-live="polite"></p>
        </form>
    </div>
</section>
