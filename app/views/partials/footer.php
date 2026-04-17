<?php
$logoUrl = htmlspecialchars($baseUrl . ($about['logo'] ?? '/assets/img/logo_inpro.png'), ENT_QUOTES, 'UTF-8');
?>
<footer class="site-footer">
    <div class="container footer-grid footer-grid--3">
        <div class="footer-col footer-col--brand">
            <img
                src="<?= $logoUrl; ?>"
                alt="Logo InPro"
                class="footer-logo"
                width="140"
                height="auto"
                loading="lazy"
            />
            <a class="footer-email" href="mailto:info@inpro.es">info@inpro.es</a>
        </div>

        <div class="footer-col footer-col--address">
            <h4 class="footer-title">Dirección</h4>
            <div class="footer-row">
                <span class="footer-text">Calle Lasaga Larreta, nº7, bajo, 39300 Torrelavega, Cantabria, España.</span>
               
            </div>
        </div>

        <div class="footer-col footer-col--phone">
            <h4 class="footer-title">Teléfono</h4>
            <div class="footer-row">
                <a class="footer-text footer-text--link" href="tel:+34658286556">658 286 556</a>
                
            </div>
        </div>
    </div>
</footer>
