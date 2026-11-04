(() => {
  const root = document.documentElement;
  root.classList.add('js');
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // pointer focus: tell cards and buttons where the mouse is so the glow and sheen follow it
  if (!reduce && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    const targets = '.card, .btn, .fab-btn';
    let last = null, queued = false;
    const place = () => {
      queued = false;
      for (let el = last.target.closest(targets); el; el = el.parentElement?.closest(targets)) {
        const r = el.getBoundingClientRect();
        el.style.setProperty('--mx', `${last.clientX - r.left}px`);
        el.style.setProperty('--my', `${last.clientY - r.top}px`);
      }
    };
    document.addEventListener('pointermove', (e) => {
      if (e.pointerType !== 'mouse' || !(e.target instanceof Element)) return;
      last = e;
      if (!queued) { queued = true; requestAnimationFrame(place); }
    }, { passive: true });
  }

  // header turns solid after the first screen (sentinel observer, no scroll listener)
  const header = document.querySelector('[data-header]');
  if (header) {
    const s = document.createElement('div');
    s.style.cssText = 'position:absolute;top:0;left:0;width:1px;height:40px;pointer-events:none';
    document.body.prepend(s);
    new IntersectionObserver(([e]) => header.classList.toggle('is-solid', !e.isIntersecting)).observe(s);
  }

  // overlay menu
  const burger = document.querySelector('[data-burger]');
  const menu = document.querySelector('[data-menu]');
  if (burger && menu) {
    const set = (open) => {
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      menu.classList.toggle('open', open);
      document.body.style.overflow = open ? 'hidden' : '';
    };
    burger.addEventListener('click', () => set(burger.getAttribute('aria-expanded') !== 'true'));
    menu.addEventListener('click', (e) => { if (e.target.closest('a')) set(false); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') set(false); });
  }

  // reveal on enter
  const items = document.querySelectorAll('.rv');
  if ('IntersectionObserver' in window && !reduce) {
    const io = new IntersectionObserver((es) => es.forEach((en) => { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } }), { threshold: .12, rootMargin: '0px 0px -5% 0px' });
    items.forEach((el) => io.observe(el));
  } else items.forEach((el) => el.classList.add('in'));

  // gallery filter
  const tabs = document.querySelector('[data-tabs]');
  const gal = document.querySelector('[data-gallery]');
  if (tabs && gal) {
    tabs.addEventListener('click', (e) => {
      const b = e.target.closest('button[data-f]');
      if (!b) return;
      tabs.querySelectorAll('button').forEach((x) => x.setAttribute('aria-pressed', String(x === b)));
      gal.querySelectorAll('.shot').forEach((sh) => { sh.hidden = b.dataset.f !== 'all' && sh.dataset.cat !== b.dataset.f; });
    });
  }

  // countdown to the next Friday 6:30 pm Perth time (AWST, UTC+8, no DST)
  const nextFriday = () => {
    const now = Date.now();
    const perth = new Date(now + 8 * 3600e3);
    let add = (5 - perth.getUTCDay() + 7) % 7;
    const t = Date.UTC(perth.getUTCFullYear(), perth.getUTCMonth(), perth.getUTCDate() + add, 18, 30) - 8 * 3600e3;
    return t <= now ? t + 7 * 864e5 : t;
  };
  const cds = document.querySelectorAll('[data-countdown]');
  if (cds.length) {
    const target = nextFriday();
    const pad = (n) => String(n).padStart(2, '0');
    const tick = () => {
      let d = Math.max(0, target - Date.now());
      const v = { d: Math.floor(d / 864e5), h: Math.floor(d / 36e5) % 24, m: Math.floor(d / 6e4) % 60, s: Math.floor(d / 1e3) % 60 };
      cds.forEach((c) => c.querySelectorAll('[data-u]').forEach((n) => { n.textContent = pad(v[n.dataset.u]); }));
    };
    tick();
    setInterval(tick, 1000);
  }

  // menu: keep keyboard focus inside the open overlay
  if (burger && menu) {
    menu.addEventListener('keydown', (e) => {
      if (e.key !== 'Tab' || !menu.classList.contains('open')) return;
      const items = [burger, ...menu.querySelectorAll('a')];
      const first = items[0], last = items[items.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    });
  }

  // map: load the Google embed (about 600KB) only when asked for
  document.querySelectorAll('[data-map-load]').forEach((btn) => btn.addEventListener('click', () => {
    const box = btn.closest('[data-map]');
    const frame = document.createElement('iframe');
    frame.title = 'Map to Himalayan Fusion Hub';
    frame.referrerPolicy = 'no-referrer-when-downgrade';
    frame.src = box.dataset.map;
    btn.replaceWith(frame);
  }));

  // back-to-top button: shown once the visitor is a screen down the page
  const toTop = document.querySelector('[data-to-top]');
  if (toTop) {
    let queued = false;
    const check = () => { queued = false; toTop.classList.toggle('show', window.scrollY > window.innerHeight * .8); };
    window.addEventListener('scroll', () => { if (!queued) { queued = true; requestAnimationFrame(check); } }, { passive: true });
    check();
    toTop.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
      document.querySelector('.brand')?.focus({ preventScroll: true });
    });
  }

  const date = document.querySelector('input[type="date"][data-min-today]');
  if (date) date.min = new Date().toLocaleDateString('en-CA');
})();
