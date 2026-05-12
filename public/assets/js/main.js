const navLinks = document.querySelectorAll('.nav-links a');
const sections = document.querySelectorAll('main section[id]');
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('.nav-links');
const contactForm = document.getElementById('contact-form');
const contactFeedback = document.getElementById('contact-feedback');

const openButtons = document.querySelectorAll('.js-open-project');
const modals = document.querySelectorAll('.project-modal');
const closeModalButtons = document.querySelectorAll('.js-close-modal');
const revealItems = document.querySelectorAll('.reveal');
const modalsWrapper = document.getElementById('project-modals');
const heroSrv = document.getElementById('hero-srv');
let lastFocusedElement = null;

menuToggle?.addEventListener('click', () => {
    const isOpen = navMenu?.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(!!isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Cerrar menú' : 'Abrir menú');
});

navLinks.forEach((link) => {
    link.addEventListener('click', () => {
        navMenu?.classList.remove('open');
        menuToggle?.setAttribute('aria-expanded', 'false');
        menuToggle?.setAttribute('aria-label', 'Abrir menú');
    });
});

const navObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const id = entry.target.getAttribute('id');
            navLinks.forEach((link) => {
                const isCurrent = link.getAttribute('href') === `#${id}`;
                link.classList.toggle('active', isCurrent);
            });
        });
    },
    { rootMargin: '-45% 0px -45% 0px' }
);

sections.forEach((section) => navObserver.observe(section));

const revealObserver = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    },
    { threshold: 0.15 }
);

revealItems.forEach((item) => revealObserver.observe(item));

// --- Server panel staggered reveal ---
if (heroSrv) {
    const rows = heroSrv.querySelectorAll('.srv-row');
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReduced) {
        heroSrv.classList.add('is-visible');
    } else {
        const srvObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                rows.forEach((row, i) => {
                    row.style.transitionDelay = `${i * 150}ms`;
                });
                const footer = heroSrv.querySelector('.srv-panel__footer');
                if (footer) footer.style.transitionDelay = `${rows.length * 150 + 200}ms`;
                heroSrv.classList.add('is-visible');
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.3 });
        srvObserver.observe(heroSrv);
    }
}

// --- Modal focus trap ---
const FOCUSABLE = 'a[href], button:not([disabled]), textarea, input:not([type="hidden"]), select, [tabindex]:not([tabindex="-1"])';

function trapFocus(event, container) {
    const focusable = [...container.querySelectorAll(FOCUSABLE)];
    if (focusable.length === 0) return;
    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
    }
}

function closeAllModals() {
    modals.forEach((modal) => modal.classList.remove('is-open'));
    document.body.classList.remove('modal-open');
    modalsWrapper?.setAttribute('aria-hidden', 'true');
    document.removeEventListener('keydown', handleModalKeydown);

    if (lastFocusedElement instanceof HTMLElement) {
        lastFocusedElement.focus();
        lastFocusedElement = null;
    }
}

function handleModalKeydown(event) {
    if (event.key === 'Escape') {
        closeAllModals();
        return;
    }
    if (event.key === 'Tab') {
        const openModal = document.querySelector('.project-modal.is-open .project-modal__panel');
        if (openModal) trapFocus(event, openModal);
    }
}

openButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const projectId = button.dataset.project;
        const targetModal = document.querySelector(`.project-modal[data-modal="${projectId}"]`);
        if (!targetModal) return;

        lastFocusedElement = button;
        modals.forEach((modal) => modal.classList.remove('is-open'));
        targetModal.classList.add('is-open');
        document.body.classList.add('modal-open');
        modalsWrapper?.setAttribute('aria-hidden', 'false');

        document.addEventListener('keydown', handleModalKeydown);

        const panel = targetModal.querySelector('.project-modal__panel');
        if (panel instanceof HTMLElement) {
            panel.focus();
        }
    });
});

closeModalButtons.forEach((button) => {
    button.addEventListener('click', closeAllModals);
});


// --- Contact form ---
contactForm?.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (!contactForm.checkValidity()) {
        contactForm.reportValidity();
        return;
    }

    const submitBtn = contactForm.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.disabled = true;
    if (contactFeedback) {
        contactFeedback.textContent = 'Enviando mensaje...';
        contactFeedback.className = 'contact-feedback';
    }

    const formData = new FormData(contactForm);

    try {
        const response = await fetch(contactForm.action, {
            method: 'POST',
            body: formData,
        });

        const contentType = response.headers.get('content-type') || '';
        let data;

        if (contentType.includes('application/json')) {
            data = await response.json();
        } else {
            throw new Error('Error al procesar la respuesta del servidor.');
        }

        // Always refresh CSRF token if server provides one
        if (data.newToken) {
            const tokenInput = contactForm.querySelector('input[name="_token"]');
            if (tokenInput) tokenInput.value = data.newToken;
        }

        if (!response.ok || !data.ok) {
            throw new Error(data.message || 'Error al enviar el formulario.');
        }

        if (contactFeedback) {
            contactFeedback.textContent = data.message;
            contactFeedback.classList.add('contact-feedback--success');
        }
        contactForm.reset();

        // Restore token in the reset form
        if (data.newToken) {
            const tokenInput = contactForm.querySelector('input[name="_token"]');
            if (tokenInput) tokenInput.value = data.newToken;
        }
    } catch (error) {
        if (contactFeedback) {
            contactFeedback.textContent = error.message || 'No se pudo enviar el mensaje.';
            contactFeedback.classList.add('contact-feedback--error');
        }
    } finally {
        if (submitBtn) submitBtn.disabled = false;
    }
});
