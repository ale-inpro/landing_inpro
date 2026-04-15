<header class="site-header">
    <nav class="nav container">
        <a class="brand" href="#inicio">
            <span class="brand-logo-wrap">
                <img
                    src="<?= htmlspecialchars($baseUrl . $about['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="Logo InPro"
                    class="brand-logo"
                >
            </span>
            <span class="brand-text">INPRO</span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Abrir menu">Menu</button>

        <ul class="nav-links">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#inpro">InPro</a></li>
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>
</header>