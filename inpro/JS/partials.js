async function loadPartials() {
    const [headerRes, footerRes] = await Promise.all([
        fetch('header.html'),
        fetch('footer.html')
    ]);
    document.getElementById('header').innerHTML = await headerRes.text();
    document.getElementById('footer').innerHTML = await footerRes.text();

    const esIndex = !!document.getElementById('card-productos');

    if (esIndex) {
        activarMenu();
        // Si venimos de una página de producto, mostrar la sección correcta
        const params = new URLSearchParams(window.location.search);
        const seccion = params.get('seccion');
        if (seccion) {
            const link = document.querySelector(`[data-target="${seccion}"]`);
            if (link) link.click();
        }
    } else {
        // En páginas de producto los links navegan al index con la sección
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');
                window.location.href = 'index.html?seccion=' + target;
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
            document.querySelector('[data-target="card-inicio"]').click();
        });
    }
}

loadPartials();
