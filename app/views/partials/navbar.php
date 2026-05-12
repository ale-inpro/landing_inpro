<header class="site-header">
    <nav class="nav container" aria-label="Navegación principal">
        <a class="brand" href="#inicio">
            <span class="brand-logo-wrap">
                <img
                    src="<?= htmlspecialchars($baseUrl . $about['logo'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="Logo INPRO"
                    class="brand-logo"
                >
            </span>
        </a>

        <button
            class="menu-toggle"
            type="button"
            aria-label="Abrir menú"
            aria-expanded="false"
            aria-controls="main-nav"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links" id="main-nav" role="list">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#inpro">Nosotros</a></li>
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </nav>
</header>