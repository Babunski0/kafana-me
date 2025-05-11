document.addEventListener('DOMContentLoaded', () => {
  console.log('✅ site.js učitan');

  // Fade in efekat sekcija prilikom skrolovanja
  const sections = document.querySelectorAll('.section');
  const fadeObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });
  sections.forEach(sec => fadeObserver.observe(sec));

  // Aktivno oznacavanje navigacionog linka tokom skrolovanja
  const navLinks = document.querySelectorAll('nav a[href^="#"]');
  const sectionMap = {};
  navLinks.forEach(link => {
    const id = link.getAttribute('href').slice(1);
    const sec = document.getElementById(id);
    if (sec) sectionMap[id] = link;
  });
  window.addEventListener('scroll', () => {
    const scrollPos = window.scrollY + window.innerHeight / 3;
    for (let id in sectionMap) {
      const sec = document.getElementById(id);
      if (sec.offsetTop <= scrollPos && sec.offsetTop + sec.offsetHeight > scrollPos) {
        navLinks.forEach(l => l.classList.remove('active'));
        sectionMap[id].classList.add('active');
      }
    }
  });

  
  document.querySelectorAll('nav a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      document.querySelector(link.getAttribute('href'))
              .scrollIntoView({ behavior: 'smooth' });
    });
  });

  // Back to Top dugme koje se pojavljuje pri skrolu
  const backBtn = document.createElement('button');
  backBtn.id = 'backToTop';
  backBtn.textContent = '↑';
  Object.assign(backBtn.style, {
    position: 'fixed', bottom: '30px', right: '30px',
    padding: '0.5rem 0.75rem', fontSize: '1.25rem',
    display: 'none', cursor: 'pointer', border: 'none',
    borderRadius: '4px', background: '#e67e22', color: '#fff',
    boxShadow: '0 2px 6px rgba(0,0,0,0.3)', zIndex: 1000
  });
  document.body.appendChild(backBtn);
  backBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  window.addEventListener('scroll', () => {
    backBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
  });

  // Automatsko nestajanje flash poruka
  const flash = document.querySelector('.flash');
  if (flash) {
    setTimeout(() => {
      flash.style.transition = 'opacity 0.5s';
      flash.style.opacity = '0';
      setTimeout(() => flash.remove(), 500);
    }, 4000);
  }

  // Provjera duplikata prilikom pokusaja rezervacije
  const buttons = document.querySelectorAll('.btn-reserve');
  console.log('📌 btn-reserve count:', buttons.length);
  buttons.forEach(btn => {
    btn.addEventListener('click', async e => {
      e.preventDefault();
      const restId = btn.dataset.id;
      const url    = `${window.BASE_URL}/check-reservation/${restId}`;
      console.log(`→ fetch ${url}`);

      try {
        const resp = await fetch(url);
        if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
        const { exists } = await resp.json();
        console.log('← JSON exists=', exists);

        if (exists) {
          alert('Već ste rezervisali ovaj restoran.');
        } else {
          window.location.href = btn.href;
        }
      } catch (err) {
        console.error('Greška pri proveri rezervacije:', err);
        alert('Došlo je do greške. Pokušajte ponovo.');
      }
    });
  });

  // Mobile navigacija
  const navToggle = document.querySelector('.nav-toggle');
  if (navToggle) {
    navToggle.addEventListener('click', () => {
      document.body.classList.toggle('nav-open');
    });
  }
});
