import './bootstrap';

// Sidebar toggle (make global)
window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    if (!sidebar || !mainContent) return;

    const isCollapsed = sidebar.classList.contains('sidebar-collapsed');

    if (!isCollapsed) {
        sidebar.classList.replace('w-75', 'w-20');
        mainContent.classList.replace('ml-80', 'ml-20');
        sidebar.classList.add('sidebar-collapsed');
    } else {
        sidebar.classList.replace('w-20', 'w-75');
        mainContent.classList.replace('ml-20', 'ml-80');
        sidebar.classList.remove('sidebar-collapsed');
    }
};


/* ================================
   DARK MODE (localStorage)
================================ */

window.toggleDarkMode = function () {
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');
    const text = document.getElementById('themeText');

    const isDark = html.classList.toggle('dark');

    // Save preference
    localStorage.setItem('theme', isDark ? 'dark' : 'light');

    // Update UI
    if (isDark) {
        icon.classList.replace('fa-moon', 'fa-sun');
        text.textContent = 'Disable dark mode';
    } else {
        icon.classList.replace('fa-sun', 'fa-moon');
        text.textContent = 'Enable dark mode';
    }
};

/* ================================
   LOAD THEME ON PAGE LOAD
================================ */

document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');
    const text = document.getElementById('themeText');

    const theme = localStorage.getItem('theme');

    if (theme === 'dark') {
        html.classList.add('dark');
        icon?.classList.replace('fa-moon', 'fa-sun');
        text && (text.textContent = 'Disable dark mode');
    } else {
        html.classList.remove('dark');
        icon?.classList.replace('fa-sun', 'fa-moon');
        text && (text.textContent = 'Enable dark mode');
    }
});