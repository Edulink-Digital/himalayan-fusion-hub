# Himalayan Fusion Hub: project handover

Status as of 4 November 2026. Website for Himalayan Fusion Hub, a Bhutanese-owned night club at
Unit 2/98 Erindale Rd, Balcatta WA 6021 (Perth). Built by Edulink Digital.

- **Live (temporary):** https://himalayan-fusion-hub.wasmer.app
- **Admin panel:** https://himalayan-fusion-hub.wasmer.app/admin
- **Wasmer dashboard:** https://wasmer.io/apps/moktan456/himalayan-fusion-hub (account `moktan456`)
- **Repository:** https://github.com/Edulink-Digital/himalayan-fusion-hub (branch `main`)

## 1. Open issue: read this first

**Admin pages freeze on the live site (Bookings, then navigating away).** Root cause is confirmed
from the live logs (4 Nov 2026, 08:45:57 UTC):

```
production.ERROR: SQLSTATE[HY000]: General error: 5 database is locked
(Connection: sqlite, Database: /data/database.sqlite,
 SQL: select * from "users" where "id" = 1 limit 1)
```

The site stores bookings, site content and the admin login in a SQLite file on a Wasmer volume
(`/data`). Wasmer Edge runs several copies of the app at once (the logs show PHP restarting at
08:40, 08:41, 08:45 and 08:52) and they share that one file. SQLite relies on file locks that this
shared volume does not handle well, so even a plain read can fail with "database is locked".
Wasmer's own docs warn that volumes are "not yet well suited to databases"
(https://docs.wasmer.io/edge/configuration). It does **not** reproduce locally, even with the live
settings, because locally there is only one PHP process.

Fix options, not yet chosen:

1. **Move the database to Wasmer's managed MySQL** (`capabilities.database` in `app.yaml`).
   This is the proper fix. Wasmer injects `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USERNAME`,
   `DB_PASSWORD`; set `DB_CONNECTION=mysql` and map those names in `config/database.php` or env.
   May need a paid Wasmer plan and a region that supports databases.
2. **Stay on SQLite but reduce clashes:** set `scaling.mode: single_concurrency` in `app.yaml`
   (one request per instance) and give the SQLite connection a `busy_timeout` (e.g. 5000 ms) so
   reads wait instead of failing. Cheaper, but locks between instances can still happen.
3. **Move off Wasmer** to a normal PHP host (Laravel Cloud, Forge/VPS, cPanel). This also removes
   the PHP 8.3 limit described below.

Steps to reproduce on live: sign in to `/admin`, click **Bookings**, then **Dashboard**. Watch logs
with `~/.wasmer/bin/wasmer app logs --watch` (the default log window only reaches back to the last
restart).

## 2. Stack

| Part | Version / notes |
|---|---|
| Laravel | 13.40 (`laravel/framework ^13.17`) |
| PHP | **8.3** on the server. `composer.json` pins `config.platform.php = 8.3.4` because Wasmer's newest PHP is 8.3, which is also why Symfony is on 7.4, not 8 |
| Admin | Filament 5.11 (needs the PHP `intl` extension) |
| Database | SQLite (local: `database/database.sqlite`; live: `/data/database.sqlite` on a Wasmer volume) |
| Front end | Plain CSS and JS in `public/css/hfh.css` and `public/js/hfh.js`, loaded with a `?v=filemtime` cache-buster. Vite/Tailwind are installed but **not used** by the public site |
| Fonts / icons | Google Fonts (Lato, Volkhov); Phosphor icons inlined as SVG in `resources/views/partials/icon.blade.php` (no icon font) |
| Tests | PHPUnit 12, 37 feature tests in `tests/Feature` |
| Dev tooling | Laravel Boost (guidelines in `CLAUDE.md`/`AGENTS.md`), Pint |

## 3. Local setup (Windows machine used so far)

Use the PHP 8.3 at `C:\Users\ITManager\.php83\php.exe` (official windows.php.net build with
`intl`, `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`, `curl`, `zip` enabled in its `php.ini`).
The php.new PHP 8.5 at `~/.config/herd-lite/bin` has no `intl`, so Filament cannot run on it.

```bash
P=/c/Users/ITManager/.php83/php.exe
C=/c/Users/ITManager/.config/herd-lite/bin/composer.phar
$P $C install
cp .env.example .env && $P artisan key:generate   # first time only
$P artisan migrate
$P artisan serve            # http://127.0.0.1:8000
$P artisan test --compact tests/Feature
$P vendor/bin/pint --dirty
```

`tests/Unit` does not exist, so run `tests/Feature` (running the whole suite errors on the missing
folder). `.claude/launch.json` (not committed) starts the dev server with this PHP for the Claude
desktop app preview.

**Local admin login:** `ADMIN_EMAIL` / `ADMIN_PASSWORD` in your local `.env` (not committed). On
boot, if no user exists and both are set, an admin user is created.

## 4. How the site works

### Content and settings
- `config/hfh.php` holds **all default content**: venue facts, contact details, social links,
  opening hours, nav, SEO text, every page's headings and paragraphs (`home`, `events_page`,
  `menu_page`, `book_page`, `footer`), features, nights, menu, FAQ, gallery, booking types, themes.
- The admin's **Site content** page (`app/Filament/Pages/SiteContent.php`) edits those values.
  Saved values go into the `site_settings` table (`app/Models/SiteSetting.php`, one row per
  top-level key in `SiteSetting::EDITABLE_KEYS`) and override the config on every request
  (`AppServiceProvider::applySavedContent`).
- Saving the phone or address also derives `phone_href`, `whatsapp`, `address_lines`,
  `maps_link`, `maps_embed` (`SiteSetting::derivedFrom`).
- Views read everything through `config('hfh.…')`, so new editable text means: add a default in
  `config/hfh.php`, a field in `SiteContent`, and (if it is a new top-level key) add it to
  `EDITABLE_KEYS`.

### Colour themes
Three themes: `midnight` (default), `disco` (Disco Ball), `vice` (Vice City). Chosen in
Admin → Site content → General & theme. The layout sets `<html data-theme="…">`; every colour in
`hfh.css` comes from CSS variables at the top of the file, and `[data-theme="disco"]` /
`[data-theme="vice"]` override them.

### Pages and routes (`routes/web.php`)
`/` home, `/events`, `/menu`, `/book` (GET form, POST stores a reservation, throttled 6/min),
`/search?q=` (searches nights, features, menu items, FAQ in `PageController::searchContent`),
`/admin` (Filament).

### Admin panel (`app/Providers/Filament/AdminPanelProvider.php`)
- **Site content:** all text, lists, theme, contact, socials, hours, SEO.
- **Bookings:** read-only inbox of reservations with search, occasion filter, view and delete
  (`app/Filament/Resources/Reservations`).
- Every user can access the panel (`User::canAccessPanel`); only admins should exist.

### Header and mobile features
Top bar (phone, email, Facebook/Instagram/TikTok) hidden on phones; desktop navbar from 1100px,
hamburger overlay below that; expandable header search. Phones also get a fixed bottom bar (Book,
Call, Directions) and floating WhatsApp / email / back-to-top buttons. Card glow and button sheen
follow the mouse on pointer devices only.

## 5. Deploying to Wasmer Edge

Files: `wasmer.toml` (package: PHP 8.3.403, maps the whole project to `/app`, starts
`php -S localhost:8080 -t /app/public /app/server.php`), `app.yaml` (env vars, `/data` volume),
`.wasmerignore` (keeps `.env`, local databases, logs, `node_modules`, `.git`, `tests`, `.claude`
out of the upload), `server.php` (router; without it Livewire's script 404s and the admin breaks;
guarded by `tests/Feature/WasmerServerTest.php`).

```bash
P=/c/Users/ITManager/.php83/php.exe; C=/c/Users/ITManager/.config/herd-lite/bin/composer.phar
$P $C install --no-dev --optimize-autoloader   # smaller upload
$P artisan view:clear
~/.wasmer/bin/wasmer deploy --non-interactive
$P $C install                                  # restore dev packages afterwards
```

- **Secrets** (set with `wasmer app secrets create NAME "value"`, add `--redeploy` on the last one):
  `APP_KEY` (set), `ADMIN_EMAIL` and `ADMIN_PASSWORD` (set by the owner).
- **First run / migrations:** with `HFH_AUTO_MIGRATE=true` the app creates the SQLite file and runs
  any new migrations once per set of migration files (marker file `/data/.migrated-<hash>`).
- **Sessions** are in cookies (`SESSION_DRIVER=cookie`); cache is in memory; logs go to stderr
  (`wasmer app logs`). Opening the Bookings table grows the session cookie to about 3 KB; keep
  this in mind if more table state is persisted (browsers drop cookies over 4 KB).
- `wasmer run .` does not work on Windows (Wasmer's runtime lacks a clock PHP needs), so test the
  live deploy directly.

## 6. Content still to confirm with the owner

Marked `CONFIRM` in `config/hfh.php`, editable in the admin panel:

- Email is a placeholder (`hfh@gmail.com`).
- Social links currently open each platform's search for "Himalayan Fusion Hub".
- Opening hours: only Friday 6:30 pm is confirmed.
- Nights are indicative formats, not a published calendar.
- Wording for snooker, the festival nights (Losar, Dashain, Tihar, Diwali), Dzongkha songbooks
  and Rigsar on the decks.
- Menu items and descriptions are sample content.
- Photos are Unsplash stock (credits in `public/images/CREDITS.md`), not the venue's own.

## 7. Working agreements with the client

- Keep the existing purple DJ-theme design; change only what is asked (a full redesign was
  rejected and reverted, see commits `dc14804` → `c9c13c8`).
- Write copy for a Bhutanese-owned club whose regulars are Bhutanese, Nepali, Indian and
  Australian.
- Mobile first: check every change at phone width.
- Footer credit "Website by Edulink Digital" links to https://digitaledulink.com.

## 8. Not done / ideas

- Fix the database lock (section 1).
- Gallery photo uploads in the admin (deferred: needs reliable file storage).
- Email/SMS notification when a booking arrives (bookings currently only appear in the admin).
- Permanent hosting with a real domain, HTTPS on that domain and backups.
- `tests/Unit` folder or a phpunit.xml change so the full test suite runs.
