(() => {
  const root = document.documentElement;
  root.classList.add('js');
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // header: solid once the page scrolls (observer on a sentinel, no scroll listener)
  const header = document.querySelector('[data-header]');
  if (header) {
    const sentinel = document.createElement('div');
    sentinel.style.cssText = 'position:absolute;top:0;left:0;width:1px;height:40px;pointer-events:none';
    document.body.prepend(sentinel);
    new IntersectionObserver(([e]) => header.classList.toggle('is-solid', !e.isIntersecting)).observe(sentinel);
  }

  // mobile menu
  const burger = document.querySelector('[data-burger]');
  const nav = document.querySelector('[data-nav]');
  if (burger && nav) {
    const set = (open) => {
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      nav.classList.toggle('open', open);
      document.body.style.overflow = open ? 'hidden' : '';
    };
    burger.addEventListener('click', () => set(burger.getAttribute('aria-expanded') !== 'true'));
    nav.addEventListener('click', (e) => { if (e.target.closest('a')) set(false); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') set(false); });
  }

  // reveal on enter
  const items = document.querySelectorAll('.rv');
  if ('IntersectionObserver' in window && !reduce) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
    }, { threshold: .15, rootMargin: '0px 0px -6% 0px' });
    items.forEach((el) => io.observe(el));
  } else {
    items.forEach((el) => el.classList.add('in'));
  }

  // light dust in the hero (canvas, paused when off screen or reduced motion)
  const cv = document.getElementById('dust');
  if (cv && !reduce) {
    const ctx = cv.getContext('2d');
    let w, h, parts = [], raf = 0, visible = true;
    const colors = ['255,46,136', '255,184,61', '167,139,250'];
    const size = () => {
      const r = cv.getBoundingClientRect();
      const dpr = Math.min(window.devicePixelRatio || 1, 2);
      w = cv.width = r.width * dpr; h = cv.height = r.height * dpr;
      const n = Math.round(Math.min(70, r.width / 18));
      parts = Array.from({ length: n }, () => ({
        x: Math.random() * w, y: Math.random() * h, r: (Math.random() * 1.8 + .6) * dpr,
        vy: -(Math.random() * .35 + .1) * dpr, vx: (Math.random() - .5) * .2 * dpr,
        c: colors[(Math.random() * colors.length) | 0], a: Math.random() * .6 + .2, t: Math.random() * 6.28,
      }));
    };
    const tick = () => {
      ctx.clearRect(0, 0, w, h);
      for (const p of parts) {
        p.x += p.vx; p.y += p.vy; p.t += .02;
        if (p.y < -10) { p.y = h + 10; p.x = Math.random() * w; }
        const a = p.a * (.6 + Math.sin(p.t) * .4);
        ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, 6.283);
        ctx.fillStyle = `rgba(${p.c},${a})`; ctx.shadowColor = `rgba(${p.c},1)`; ctx.shadowBlur = 12; ctx.fill();
      }
      raf = visible ? requestAnimationFrame(tick) : 0;
    };
    size();
    window.addEventListener('resize', size);
    new IntersectionObserver(([e]) => { visible = e.isIntersecting; if (visible && !raf) tick(); }).observe(cv);
    tick();
  }

  // booking form: min date today
  const date = document.querySelector('input[type="date"][data-min-today]');
  if (date) date.min = new Date().toLocaleDateString('en-CA');
})();
