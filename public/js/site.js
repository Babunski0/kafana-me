document.addEventListener('DOMContentLoaded', () => {
  // Fade-in sekcije (ne diraš)
  const sections = document.querySelectorAll('.section');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.2 });
  sections.forEach(s => observer.observe(s));

  // Smooth scroll za interne linkove (ne diraš)
  document.querySelectorAll('nav a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      document.querySelector(link.getAttribute('href'))
              .scrollIntoView({ behavior: 'smooth' });
    });
  });

  // PROVERA DUPLIKATA pre nego što pošaljemo korisnika na /reserve/ID
  document.querySelectorAll('a.btn-reserve').forEach(btn => {
    btn.addEventListener('click', async e => {
      e.preventDefault();

      const restId = btn.dataset.id;
      const checkUrl = `${window.BASE_URL}/check-reservation/${restId}`;

      try {
        const resp = await fetch(checkUrl, {
          headers: { 'Accept': 'application/json' }
        });
        if (!resp.ok) throw new Error('Mrežna greška pri proveri rezervacije');

        const { exists } = await resp.json();
        if (exists) {
          alert('Već ste rezervisali ovaj restoran.');
        } else {
          // Nije rezervisao – nastavljamo na stvarnu rezervaciju
          window.location.href = btn.href;
        }
      } catch (err) {
        console.error(err);
        alert('Došlo je do greške. Pokušajte ponovo.');
      }
    });
  });
});
