# VØID ROASTERS

**A brutalist WordPress theme — built from scratch, zero frameworks, zero bloat.**

---

## Overview

VØID ROASTERS is a bespoke WordPress theme architected for maximum performance and minimal DOM depth. It was built entirely without CSS frameworks (no Tailwind, no Bootstrap) or heavy JavaScript runtimes — relying solely on modern native APIs, CSS custom properties, and the WordPress template hierarchy.

The theme is designed around a brutalist aesthetic: pitch-black backgrounds, off-white text, acid-green accents (`#d4ff00`), massive fluid typography, thick borders, solid offset shadows, and an asymmetric 12-column CSS Grid system.

---

## Architecture

```
void-roasters-theme/
├── CLAUDE.md                         # Agentic development environment matrix
├── README.md                         # This file
├── generate-demo-content.sh          # WP-CLI demo content generator
├── style.css                         # Theme headers + bespoke CSS custom property engine
├── functions.php                     # Theme setup, supports, asset enqueue
├── header.php                        # Semantic HTML5 header with skip-link + nav
├── footer.php                        # Semantic HTML5 footer
├── index.php                         # Main template (blog/archive loop)
├── front-page.php                    # Front page: hero + custom WP_Query roast loop
└── template-parts/
    ├── content.php                   # Default post card (archive view)
    └── content-roast.php             # Roast card (front page loop)
```

### Design Decisions

| Principle | Implementation |
|---|---|
| **No frameworks** | 100% bespoke CSS custom property engine. Zero Bootstrap, Tailwind, or preprocessors. Reduces DOM depth and eliminates unused CSS. |
| **Fluid math over rigid pixels** | All typography, spacing, and layout use `clamp()` for seamless scaling across any viewport. No media query breakpoints needed for core sizing. |
| **BEM naming convention** | All CSS classes follow Block-Element-Moderator (BEM) — `.hero__title`, `.roast-card__excerpt`, `.btn--primary`. |
| **12-column asymmetric grid** | Pure CSS Grid with `.col-span-*` and `.col-start-*` utilities. Collapses to single-column on mobile. |
| **Defensive escaping** | Every dynamic WordPress output is wrapped in `esc_html()`, `esc_attr()`, `esc_url()`, or `wp_kses_post()`. Zero raw `echo` statements. |
| **Semantic HTML5** | `<header>`, `<main>`, `<footer>`, `<article>`, `<nav>`, `<section>`, `<time>` with ARIA labels and skip-link. |
| **Native JS only** | No jQuery. Uses `IntersectionObserver`, native modules, and Web Crypto where JS is needed. |

---

## The CLAUDE.md Development Matrix

This theme was built using an **agentic development environment** defined in `CLAUDE.md`. The matrix directs four operational personas that dynamically control code generation:

### Personas

| Persona | Role | Controls |
|---|---|---|
| **[DESIGN]** | Senior UI/UX Architect | Swiss International Typographic Style, strict grid alignment, micro-interactions, fluid spacing via `clamp()`. |
| **[DEV]** | Elite WordPress Core Engineer | Modular, decoupled PHP adhering to WPCS. Zero bloat. All functions prefixed `void_`. |
| **[PM]** | Technical Project Manager | File directory structure, code-documentation mapping, commit history, README generation. |
| **[QA]** | Security Auditor | XSS prevention, input sanitization, output escaping. Blocks code generation until escaping is verified. |

### Automated Validation Workflow (§3)

After every PHP/CSS file modification, the CLAUDE.md matrix enforces:

1. **Syntax check** — `php -l <filename>` on all PHP files (when PHP is available).
2. **Prefix audit** — All custom functions must use the `void_` prefix.
3. **Conventional Commits** — Every working state is committed with semantic messages (e.g., `feat(design):`, `feat(qa):`).

### Core Architecture Constraints (§2)

- No CSS frameworks — bespoke custom property engine only.
- No heavy JS runtimes — native modern APIs exclusively.
- Strict template hierarchy — components split into `template-parts/`.
- Security mandate — all dynamic `echo` statements wrapped in WP escaping functions.

---

## Installation

### 1. Clone or Download

```bash
cd wp-content/themes/
git clone <repository-url> void-roasters
```

Or download and extract into `wp-content/themes/void-roasters/`.

### 2. Activate the Theme

Via WP Admin: **Appearance → Themes → VØID ROASTERS → Activate**

Or via WP-CLI:
```bash
wp theme activate void-roasters
```

### 3. Run the Demo Content Script

The `generate-demo-content.sh` script programmatically creates the full demo layout:

```bash
# Navigate to the theme directory
cd wp-content/themes/void-roasters/

# Make the script executable
chmod +x generate-demo-content.sh

# Run it (defaults to current WordPress root, or set WP_PATH)
./generate-demo-content.sh

# Or specify a custom WordPress path:
WP_PATH=/var/www/html ./generate-demo-content.sh
```

#### What the Script Does

| Step | Action |
|---|---|
| 1 | Activates the VØID ROASTERS theme |
| 2 | Creates "Home" and "Roasts" pages |
| 3 | Configures Settings → Reading → Static front page (Home) and Posts page (Roasts) |
| 4 | Creates 3 single-origin roast posts with rich content, tasting notes, and metadata |
| 5 | Imports placeholder featured images (brutalist palette: `#0b0b0b` / `#d4ff00`) |
| 6 | Sets permalink structure to `/%postname%/` |
| 7 | Creates a "Primary Menu" with Home + Roasts links and assigns it to the primary location |

#### Requirements

- **WordPress** 6.0+ installed and running
- **WP-CLI** available in your PATH ([install guide](https://wp-cli.org/#installing))
- Run the script from the WordPress root directory, or set `WP_PATH` to point to it

#### After Running

Visit your site's front page to see:
- A massive typographic hero section with the site name and tagline
- A "Curated Origins" section displaying the 3 most recent roast posts as brutalist cards
- A sticky header with navigation and a footer with copyright

#### Troubleshooting Featured Images

If the script fails to import placeholder images (common on servers with `allow_url_fopen` disabled):
1. Go to **wp-admin → Posts**
2. Edit each post and set a featured image manually via the Media Library
3. Recommended image size: 800×600px

---

## Development

### CSS Custom Property Engine

All design tokens live in `:root` in `style.css`. Override them to rebrand:

```css
:root {
    --void-color-primary: #0b0b0b;
    --void-color-surface: #f9f9f9;
    --void-color-accent: #d4ff00;
    --void-font-size-h1: clamp(3.5rem, 2rem + 7.5vw, 9rem);
    /* ... 50+ tokens for colors, type, spacing, grid, borders, shadows, z-index */
}
```

### 12-Column Grid

Use the grid utilities for asymmetric layouts:

```html
<div class="grid-12">
    <div class="col-span-8 col-start-1">Content</div>
</div>
```

### Template Parts

Add new template parts in `template-parts/` and load them with:

```php
<?php get_template_part( 'template-parts/content', 'variant' ); ?>
```

This loads `template-parts/content-variant.php`.

---

## Commits

This project uses [Conventional Commits](https://www.conventionalcommits.org/):

```
feat(theme): scaffold VØID root architecture
feat(design): overhaul design tokens — brutalist palette, editorial typography, 12-col grid
feat(template): front-page.php with hero + custom WP_Query roast loop
feat(qa): security audit pass + generate-demo-content.sh
docs: production-grade README.md with architecture docs
```

---

## License

GPL-2.0-or-later. See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).