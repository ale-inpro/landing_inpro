const navLinks = document.querySelectorAll('.nav-links a');
const sections = document.querySelectorAll('main section[id]');
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('.nav-links');
const contactForm = document.getElementById('contact-form');
const contactFeedback = document.getElementById('contact-feedback');

const openButtons = document.querySelectorAll('.js-open-project');
const modals = document.querySelectorAll('.project-modal');
const closeModalButtons = document.querySelectorAll('.js-close-modal');

menuToggle?.addEventListener('click', () => {
    navMenu?.classList.toggle('open');
});

navLinks.forEach((link) => {
    link.addEventListener('click', () => navMenu?.classList.remove('open'));
});

const observer = new IntersectionObserver(
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

sections.forEach((section) => observer.observe(section));

function closeAllModals() {
    modals.forEach((modal) => modal.classList.remove('is-open'));
    document.body.classList.remove('modal-open');
}

openButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const projectId = button.dataset.project;
        const targetModal = document.querySelector(`.project-modal[data-modal="${projectId}"]`);
        if (!targetModal) return;

        closeAllModals();
        targetModal.classList.add('is-open');
        document.body.classList.add('modal-open');
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
        const data = await response.json();

        if (!response.ok || !data.ok) {
            throw new Error(data.message || 'Error al enviar el formulario');
        }

        contactFeedback.textContent = data.message;
        contactForm.reset();
    } catch (error) {
        contactFeedback.textContent = error.message || 'No se pudo enviar el mensaje.';
    }
});