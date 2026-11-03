const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* Each field's ground and ink, so the top bar and the browser chrome can follow the chapter beneath. */
const fields = {
    paper: ['#eceeee', '#14131b'],
    night: ['#14131b', '#eceeee'],
    crimson: ['#b3122e', '#ffffff'],
    saffron: ['#f4a81d', '#14131b'],
    blue: ['#1f3d9a', '#f4f3ff'],
    jade: ['#0d5c46', '#f1f7ef'],
};

function followChapters() {
    const bar = document.querySelector('[data-bar]');
    const chapters = [...document.querySelectorAll('[data-field]')];
    const themeColor = document.querySelector('meta[name="theme-color"]');
    if (!bar || !chapters.length) return;

    let current = '';
    let queued = false;

    const update = () => {
        queued = false;
        const line = bar.offsetHeight;
        let field = 'paper';
        for (const chapter of chapters) {
            const box = chapter.getBoundingClientRect();
            if (box.top <= line && box.bottom > line) field = chapter.dataset.field;
        }
        if (field === current) return;
        current = field;
        const [ground, ink] = fields[field] ?? fields.paper;
        bar.style.setProperty('--bar-bg', ground);
        bar.style.setProperty('--bar-ink', ink);
        bar.style.setProperty('--accent', field === 'saffron' ? '#14131b' : '#f4a81d');
        bar.style.setProperty('--accent-ink', field === 'saffron' ? '#eceeee' : '#14131b');
        themeColor?.setAttribute('content', ground);
    };

    const queue = () => {
        if (!queued) {
            queued = true;
            requestAnimationFrame(update);
        }
    };

    window.addEventListener('scroll', queue, { passive: true });
    window.addEventListener('resize', queue);
    update();
}

function menuSheet() {
    const sheet = document.querySelector('[data-sheet]');
    const opener = document.querySelector('[data-menu-open]');
    if (!sheet || !opener) return;

    const focusable = () => [...sheet.querySelectorAll('a, button')];

    const close = () => {
        sheet.hidden = true;
        opener.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        opener.focus();
    };

    opener.addEventListener('click', () => {
        sheet.hidden = false;
        opener.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        focusable()[1]?.focus();
    });

    sheet.querySelector('[data-menu-close]')?.addEventListener('click', close);
    sheet.addEventListener('click', (event) => {
        if (event.target.closest('.sheet-links a')) close();
    });
    sheet.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close();
        if (event.key !== 'Tab') return;
        const items = focusable();
        const first = items[0];
        const last = items[items.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });
}

/* Parts of each section rise in turn as it enters; content is visible without script. */
function entrances() {
    const parts = document.querySelectorAll('.rise');
    if (reduceMotion || !('IntersectionObserver' in window)) {
        parts.forEach((part) => part.classList.add('in'));
        return;
    }

    document.querySelectorAll('section, .hero').forEach((section) => {
        section.querySelectorAll('.rise').forEach((part, index) => part.style.setProperty('--i', Math.min(index, 6)));
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px' });

    parts.forEach((part) => observer.observe(part));
}

function dayTabs() {
    document.querySelectorAll('[data-tabs]').forEach((group) => {
        const tabs = [...group.querySelectorAll('[role="tab"]')];
        const panels = [...group.querySelectorAll('[data-panel]')];

        const select = (tab, focus = false) => {
            tabs.forEach((other) => {
                const active = other === tab;
                other.setAttribute('aria-selected', String(active));
                other.tabIndex = active ? 0 : -1;
            });
            panels.forEach((panel) => {
                panel.hidden = panel.id !== tab.getAttribute('aria-controls');
                if (!panel.hidden) panel.querySelectorAll('.rise').forEach((part) => part.classList.add('in'));
            });
            if (focus) tab.focus();
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => select(tab));
            tab.addEventListener('keydown', (event) => {
                const step = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 }[event.key];
                if (!step) return;
                event.preventDefault();
                select(tabs[(index + step + tabs.length) % tabs.length], true);
            });
        });

        select(tabs.find((tab) => tab.getAttribute('aria-selected') === 'true') ?? tabs[0]);
    });
}

function picks() {
    const root = document.querySelector('[data-picks]');
    if (!root) return;
    const disc = root.querySelector('[data-disc]');
    const fact = root.querySelector('[data-pick-fact]');
    const images = [...root.querySelectorAll('[data-pick-img]')];

    root.querySelectorAll('[data-pick]').forEach((button) => {
        button.addEventListener('click', () => {
            root.querySelectorAll('[data-pick]').forEach((other) => other.setAttribute('aria-pressed', String(other === button)));
            images.forEach((image) => { image.hidden = image.dataset.pickImg !== button.dataset.pick; });
            disc.dataset.tone = button.dataset.tone;
            fact.textContent = button.dataset.fact;
        });
    });
}

/* Live countdown to the doors, in the visitor's own clock. */
function countdowns() {
    const blocks = document.querySelectorAll('[data-countdown]');
    if (!blocks.length) return;
    const pad = (n) => String(n).padStart(2, '0');

    const tick = () => {
        blocks.forEach((block) => {
            const label = block.querySelector('.doors-label');
            const text = block.querySelector('[data-countdown-text]');
            const left = new Date(block.dataset.countdown).getTime() - Date.now();

            if (left <= 0 && left > -6 * 36e5) {
                label.textContent = 'Right now:';
                text.textContent = 'the doors are open';
                return;
            }

            const total = Math.max(0, Math.floor(left / 1000));
            const days = Math.floor(total / 86400);
            const clock = `${pad(Math.floor(total / 3600) % 24)}:${pad(Math.floor(total / 60) % 60)}:${pad(total % 60)}`;
            text.textContent = days > 0 ? `${days} ${days === 1 ? 'day' : 'days'}, ${clock}` : clock;
        });
    };

    tick();
    setInterval(tick, 1000);
}

function clocks() {
    const stamps = document.querySelectorAll('[data-clock-tz]');
    if (!stamps.length) return;

    const tick = () => stamps.forEach((stamp) => {
        stamp.textContent = new Intl.DateTimeFormat('en-AU', { hour: 'numeric', minute: '2-digit', timeZone: stamp.dataset.clockTz })
            .format(new Date())
            .toLowerCase();
    });

    tick();
    setInterval(tick, 30000);
}

/* The gallery row scrolls natively; with a mouse it can also be dragged. */
function dragRow() {
    document.querySelectorAll('[data-row]').forEach((row) => {
        let startX = 0;
        let startScroll = 0;
        let dragging = false;

        row.addEventListener('pointerdown', (event) => {
            if (event.pointerType !== 'mouse') return;
            dragging = true;
            startX = event.clientX;
            startScroll = row.scrollLeft;
            row.style.scrollSnapType = 'none';
            row.setPointerCapture(event.pointerId);
        });
        row.addEventListener('pointermove', (event) => {
            if (dragging) row.scrollLeft = startScroll - (event.clientX - startX);
        });
        const stop = () => {
            dragging = false;
            row.style.scrollSnapType = '';
        };
        row.addEventListener('pointerup', stop);
        row.addEventListener('pointercancel', stop);
        row.addEventListener('dragstart', (event) => event.preventDefault());
    });
}

function bookingForm() {
    const form = document.querySelector('[data-form]');
    if (!form) return;

    const date = form.querySelector('input[type="date"][data-min-today]');
    if (date) date.min = new Date().toLocaleDateString('en-CA');

    const guests = form.querySelector('#guests');
    form.querySelectorAll('[data-step]').forEach((button) => {
        button.addEventListener('click', () => {
            const next = (parseInt(guests.value, 10) || 0) + Number(button.dataset.step);
            guests.value = Math.min(Number(guests.max), Math.max(Number(guests.min), next));
        });
    });

    form.addEventListener('submit', () => {
        form.querySelector('[data-submit]')?.setAttribute('aria-busy', 'true');
    });
}

followChapters();
menuSheet();
entrances();
dayTabs();
picks();
countdowns();
clocks();
dragRow();
bookingForm();
