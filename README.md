# twig-wrapper example

A refreshed 2026 demo for the original [`voku/twig-wrapper`](https://github.com/voku/twig-wrapper) API.

## What changed

- modern Composer setup with PHP 8.3+ and Twig 3.26
- local compatibility wrapper that keeps the classic `voku\\twig\\TwigWrapper` demo API alive
- current npm-based asset build with Bootstrap 5, Sass, Autoprefixer, Holder.js, and Terser
- cleaned-up templates, copy, and layout for a more current demo feel

## Quick start

```bash
composer install
npm install
npm run build
php -S 127.0.0.1:8000
```

Then open <http://127.0.0.1:8000>.

## Project layout

- `/src/voku/twig` – modern compatibility wrapper for the legacy example API
- `/scss` – source styles for the demo
- `/css` and `/css-min` – generated stylesheets
- `/js` and `/js-min` – generated JavaScript bundles

## Validation

```bash
composer validate --strict
php index.php > /tmp/twig-wrapper-example.html
npm run build
```
