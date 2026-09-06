# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build & Development

There is no build pipeline. SCSS must be compiled manually using a tool like VS Code's Live Sass Compiler or the Sass CLI:

```bash
# Compile once
sass assets/scss/style.scss assets/scss/style.css

# Watch mode
sass --watch assets/scss/style.scss:assets/scss/style.css
```

The compiled `style.css` and `style.css.map` are committed to the repository. After editing any `.scss` file, recompile and commit both the SCSS source and the compiled CSS together.

## Architecture Overview

This is a custom WordPress theme for a Japanese activity/tour booking business (Hatatate Marine Services). It is based on the "Titan" framework with heavy customization.

### Template Structure

- `index.php` — Homepage, assembles sections via `get_template_part()`
- `page-{slug}.php` — Custom page templates (e.g. `page-contact.php`, `page-access.php`)
- `single-{post-type}.php` — Single views per post type (`single-news.php`, `single-activity.php`)
- `archive-{post-type}.php` — Archive listings (`archive-news.php`, `archive-activity.php`)
- `template/` — Reusable section partials, loaded with `get_template_part('template/...')`

The homepage (`index.php`) is composed entirely of template parts: `header-slider`, `main-top-activity1`, `main-top-activity2`, `about`, `staff`, `equipments`, `latest-blog`, `latest-news`, etc.

### Custom Post Types (registered in `functions.php`)

| Post Type | Label (JP) | Archive | Taxonomy |
|-----------|-----------|---------|----------|
| `blog` | ブログ投稿 | Yes | `blog_category`, `blog_tag` |
| `news` | お知らせ投稿 | Yes | — |
| `activity` | アクティビティ | Yes | `activity_category` |

All custom post types have REST API enabled and support: title, editor, thumbnail, custom-fields, excerpt.

Archive pages show 5 posts per page (set via `custom_posts_per_page` filter in `functions.php`).

### SCSS Organization

All partials are in `assets/scss/` and imported by `style.scss`. Key files:
- `_common.scss` — Base resets, transitions, shared utilities
- `_typography.scss` — Font families and heading styles (Google Fonts: Noto Sans JP, M PLUS 1p, Zen Kaku Gothic, Kosugi Maru)
- `_media_querries.scss` — All responsive breakpoints
- `_navbar.scss` / `_header.scss` — Navigation and page headers

Partial names map directly to their template part: `_activity.scss` styles `template/activity-*.php`, `_access.scss` styles `page-access.php`, etc.

Several SCSS partials exist for unused features from the base framework (`_shop_items.scss`, `_restaurant_menu.scss`, etc.) — these can be ignored.

### JavaScript

Scripts are in `assets/js/` (custom) and `assets/lib/` (third-party, pre-bundled, committed to repo). There is no module bundler.

- `main.js` — Preloader, WOW.js animations, navbar behavior, parallax, scroll-to-top
- `plugins.js` — jQuery plugin initialization (Flexslider, Isotope, bxSlider, Magnific Popup)
- `swiper.js` — Swiper carousel setup
- `videoActive.js` — Video activation
- `createTableOfContents.js` / `createTableOfSideContents.js` — Auto-generated TOC for blog posts (enqueued only on `blog` post type singles via `enqueue_custom_scripts()` in `functions.php`)

All scripts are enqueued in `functions.php` via `wp_enqueue_script()`.

### Contact/Form Handling

PHP form handlers live in `php/`:
- `contact.php` — Contact form
- `reservation.php` — Booking/reservation
- `request_call.php` — Callback request
- `subscribe.php` — Newsletter (uses MailChimp via `php/inc/MCAPI.class.php`)

### Navbar

The navbar is implemented as a fixed template part (`template/navbar.php`) and loaded in `header.php`. A secondary `template/navbar-top.php` handles the top utility bar. The navbar uses Bootstrap 3's mobile collapse pattern plus custom JS in `main.js`.
