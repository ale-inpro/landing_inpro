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
let lastFocusedElement = null;

menuToggle?.addEventListener('click', () => {
    navMenu?.classList.toggle('open');
});

navLinks.forEach((link) => {
    link.addEventListener('click', () => navMenu?.classList.remove('open'));
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

function closeAllModals() {
    modals.forEach((modal) => modal.classList.remove('is-open'));
    document.body.classList.remove('modal-open');
    modalsWrapper?.setAttribute('aria-hidden', 'true');

    if (lastFocusedElement instanceof HTMLElement) {
        lastFocusedElement.focus();
        lastFocusedElement = null;
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

        const panel = targetModal.querySelector('.project-modal__panel');
        if (panel instanceof HTMLElement) {
            panel.focus();
        }
    });
});

closeModalButtons.forEach((button) => {
    button.addEventListener('click', closeAllModals);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeAllModals();
});

contactForm?.addEventListener('submit', async (event) => {
    event.preventDefault();
    contactFeedback.textContent = 'Enviando mensaje...';

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
            const raw = await response.text();
            throw new Error(`Respuesta no JSON del servidor: ${raw.slice(0, 120)}`);
        }

        if (!response.ok || !data.ok) {
            throw new Error(
                data.debug
                  ? `${data.message} | ${JSON.stringify(data.debug)}`
                  : (data.message || 'Error al enviar el formulario')
              );
        }

        contactFeedback.textContent = data.message;
        contactForm.reset();
    } catch (error) {
        contactFeedback.textContent = error.message || 'No se pudo enviar el mensaje.';
    }
});