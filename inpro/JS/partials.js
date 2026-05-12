async function loadPartials() {
    try {
        const [headerRes, footerRes] = await Promise.all([
            fetch('header.html'),
            fetch('footer.html')
        ]);

        if (!headerRes.ok || !footerRes.ok) {
            return;
        }

        const headerEl = document.getElementById('header');
        const footerEl = document.getElementById('footer');
        if (headerEl) headerEl.innerHTML = await headerRes.text();
        if (footerEl) footerEl.innerHTML = await footerRes.text();
    } catch {
        return;
    }

    const esIndex = !!document.getElementById('card-productos');
    const validTargets = ['card-inicio', 'card-productos', 'card-esencia', 'card-contacto'];

    if (esIndex) {
        activarMenu();
        const params = new URLSearchParams(window.location.search);
        const seccion = params.get('seccion');
        if (seccion && validTargets.includes(seccion)) {
            const link = document.querySelector(`[data-target="${seccion}"]`);
            if (link) link.click();
        }
    } else {
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');
                if (target && validTargets.includes(target)) {
                    window.location.href = 'index.html?seccion=' + encodeURIComponent(target);
                }
            });
        });

        const logo = document.getElementById('logo-inpro');
        if (logo) {
            logo.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = 'index.html';
            });
        }
    }
}

function activarMenu() {
    const navLinks = document.querySelectorAll('.nav-link');
    const cards = document.querySelectorAll('.content-card');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            cards.forEach(card => card.classList.remove('active'));
            navLinks.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            const targetId = this.getAttribute('data-target');
            const targetCard = document.getElementById(targetId);
            if (targetCard) targetCard.classList.add('active');
        });
    });

    const logo = document.getElementById('logo-inpro');
    if (logo) {
        logo.addEventListener('click', function(e) {
            e.preventDefault();
            const inicioLink = document.querySelector('[data-target="card-inicio"]');
            if (inicioLink) inicioLink.click();
        });
    }
}

loadPartials();
