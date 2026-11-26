// Mobile navigation
const toggle = document.querySelector('.nav-toggle');
const nav = document.getElementById('nav');
if (toggle) {
  toggle.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
  });
}

// Menu category filter (menu.php)
const filters = document.querySelectorAll('[data-filter]');
const items = document.querySelectorAll('#menu-grid .card');
function applyFilter(cat) {
  filters.forEach(b => b.classList.toggle('active', b.dataset.filter === cat));
  items.forEach(c => { c.hidden = !(cat === 'All' || c.dataset.cat === cat); });
}
if (filters.length) {
  filters.forEach(b => b.addEventListener('click', () => {
    applyFilter(b.dataset.filter);
    history.replaceState(null, '', b.dataset.filter === 'All' ? 'menu.php' : '?cat=' + encodeURIComponent(b.dataset.filter));
  }));
  applyFilter(new URLSearchParams(location.search).get('cat') || 'All');
}

// Confirm before deleting (admin pages)
document.querySelectorAll('form[data-confirm]').forEach(f => {
  f.addEventListener('submit', ev => { if (!confirm(f.dataset.confirm)) ev.preventDefault(); });
});

// Contact form validation
const cf = document.getElementById('contact-form');
if (cf) {
  cf.addEventListener('submit', ev => {
    const email = cf.email.value.trim();
    const ok = cf.name.value.trim() && /^\S+@\S+\.\S+$/.test(email) && cf.subject.value.trim() && cf.message.value.trim().length >= 10;
    if (!ok) {
      ev.preventDefault();
      document.getElementById('form-error').textContent = 'Enter your name, a valid email, a subject and a message of at least 10 characters.';
    }
  });
}
