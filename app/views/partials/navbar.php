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
        </a>

        <button class="menu-toggle" type="button" aria-label="Abrir menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links">
            <li><a href="#inicio">INICIO</a></li>
            <li><a href="#inpro">INPRO</a></li>
            <li><a href="#servicios">SERVICIOS</a></li>
            <li><a href="#contacto">CONTACTO</a></li>
        </ul>
    </nav>
</header>