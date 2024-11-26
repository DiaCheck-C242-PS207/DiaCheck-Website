// Dark Mode
const darkModeToggle = document.querySelector('.dark-mode-toggle');
const darkModeIcon = darkModeToggle.querySelector('i');

// Cek localStorage untuk status mode gelap
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark');
    darkModeIcon.className = 'bx bx-moon';
}

darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');

    if (document.body.classList.contains('dark')) {
        // Simpan status ke localStorage
        localStorage.setItem('dark-mode', 'enabled');
        darkModeIcon.className = 'bx bx-moon';
    } else {
        // Hapus status dari localStorage
        localStorage.setItem('dark-mode', 'disabled');
        darkModeIcon.className = 'bx bx-sun';
    }
});