    /* ---- MENU HAMBURGUER ---- */
    const toggle  = document.getElementById('menu-toggle');
    const navbar  = document.getElementById('navbar');
    const overlay = document.getElementById('menu-overlay');

    function openMenu() {
        toggle.classList.add('open');
        navbar.classList.add('active');
        overlay.classList.add('active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        toggle.classList.remove('open');
        navbar.classList.remove('active');
        overlay.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', () => {
        navbar.classList.contains('active') ? closeMenu() : openMenu();
    });

    overlay.addEventListener('click', closeMenu);

    /* Fecha ao clicar em qualquer link do menu mobile */
    navbar.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

/* ---- TROCA DE TEMA ---- */
const themeBtn = document.getElementById('theme-toggle');
const html     = document.documentElement;

function applyTheme(theme) {
    html.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);

    if (theme === 'dark') {
        themeBtn.innerHTML = `
            <span class="theme-icon"><i class="fa-solid fa-sun"></i></span>
            <span class="theme-label">Claro</span>
        `;
        themeBtn.setAttribute('aria-label', 'Mudar para tema claro');
    } else {
        themeBtn.innerHTML = `
            <span class="theme-icon"><i class="fa-solid fa-moon"></i></span>
            <span class="theme-label">Escuro</span>
        `;
        themeBtn.setAttribute('aria-label', 'Mudar para tema escuro');
    }
}

applyTheme(html.getAttribute('data-theme') || 'dark');

themeBtn.addEventListener('click', () => {
    applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
});


