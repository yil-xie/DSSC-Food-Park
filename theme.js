// theme.js
document.addEventListener('DOMContentLoaded', () => {
  const settings = JSON.parse(localStorage.getItem('userSettings'));
  if (settings && settings.darkMode) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
});