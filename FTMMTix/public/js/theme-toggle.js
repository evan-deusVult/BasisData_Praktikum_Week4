document.addEventListener('DOMContentLoaded', () => {
  const themeToggle = document.getElementById('theme-toggle');
  const body = document.body;

  // Cek preferensi mode dari localStorage
  const currentTheme = localStorage.getItem('theme');
  if (currentTheme === 'dark') {
    body.classList.add('dark-mode');
    themeToggle.textContent = '☀️ Light Mode';
  }

  // Event listener untuk tombol toggle
  themeToggle.addEventListener('click', () => {
    if (body.classList.contains('dark-mode')) {
      body.classList.remove('dark-mode');
      themeToggle.textContent = '🌙 Dark Mode';
      localStorage.setItem('theme', 'light');
    } else {
      body.classList.add('dark-mode');
      themeToggle.textContent = '☀️ Light Mode';
      localStorage.setItem('theme', 'dark');
    }
  });
});