(() => {
  const root = document.documentElement;
  root.classList.add('js');
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // preloader
  const pre = document.querySelector('[data-preloader]');
  const hidePre = () => pre && pre.classList.add('done');
  if (document.readyState === 'complete') setTimeout(hidePre, 250);
  else window.addEventListener('load', () => setTimeout(hidePre, 250));
  setTimeout(hidePre, 2500);

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

  const date = document.querySelector('input[type="date"][data-min-today]');
  if (date) date.min = new Date().toLocaleDateString('en-CA');
})();
