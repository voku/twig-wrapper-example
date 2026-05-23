<?php

declare(strict_types=1);

require_once __DIR__ . '/inc_globals.php';

$navigation = [
    ['label' => 'Overview', 'href' => '#overview'],
    ['label' => 'Highlights', 'href' => '#highlights'],
    ['label' => 'Workflow', 'href' => '#workflow'],
    ['label' => 'Source', 'href' => 'https://github.com/voku/twig-wrapper-example', 'external' => true],
];

$heroSlides = [
    [
        'eyebrow' => 'Twig wrapper, refreshed',
        'headline' => 'A tiny legacy API with a modern 2026 setup.',
        'text' => 'The demo now runs on PHP 8.3+, Twig 3.26, and a current Bootstrap 5 asset pipeline.',
        'cta' => ['label' => 'Explore the source', 'href' => 'https://github.com/voku/twig-wrapper-example'],
        'placeholder' => 'holder.js/1280x640/auto/#101828:#f8fafc/text:Twig+Wrapper+2026',
    ],
    [
        'eyebrow' => 'Modern dependencies',
        'headline' => 'Composer and npm are finally doing the heavy lifting again.',
        'text' => 'The demo no longer depends on Grunt, Bower, Compass, or a checked-in vendor tree to feel alive.',
        'cta' => ['label' => 'See the workflow', 'href' => '#workflow'],
        'placeholder' => 'holder.js/1280x640/auto/#1d4ed8:#eff6ff/text:Composer+%2B+npm',
    ],
    [
        'eyebrow' => 'Still familiar',
        'headline' => 'The classic TwigWrapper example API still works.',
        'text' => 'You can keep using assign() and render(), while Twig itself stays current and secure.',
        'cta' => ['label' => 'Jump to highlights', 'href' => '#highlights'],
        'placeholder' => 'holder.js/1280x640/auto/#7c3aed:#f5f3ff/text:Legacy+API%2C+modern+internals',
    ],
];

$featureCards = [
    [
        'title' => 'Modern PHP runtime',
        'text' => 'The example is now built for PHP 8.3+ and uses strict types throughout the local wrapper layer.',
        'badge' => 'PHP 8.3+',
        'placeholder' => 'holder.js/160x160/auto/#0f172a:#e2e8f0/text:PHP',
    ],
    [
        'title' => 'Current Twig core',
        'text' => 'Twig 3.26 replaces the original dev-master dependency and closes known security issues.',
        'badge' => 'Twig 3.26',
        'placeholder' => 'holder.js/160x160/auto/#1e293b:#e2e8f0/text:Twig',
    ],
    [
        'title' => 'Fast frontend build',
        'text' => 'Sass, Autoprefixer, Terser, and Bootstrap 5 provide a much lighter workflow than the 2014 toolchain.',
        'badge' => 'Bootstrap 5',
        'placeholder' => 'holder.js/160x160/auto/#334155:#e2e8f0/text:UI',
    ],
];

$releaseHighlights = [
    [
        'title' => 'Drop-in compatibility wrapper',
        'text' => 'A small local compatibility layer keeps the original TwigWrapper demo style readable while swapping in Twig\Environment under the hood.',
    ],
    [
        'title' => 'Cleaner template data flow',
        'text' => 'Navigation, hero slides, and feature content now come from structured PHP arrays instead of inline raw HTML fragments.',
    ],
    [
        'title' => 'A real build story again',
        'text' => 'A single `npm run build` command regenerates the CSS and JavaScript bundles with maintained tooling.',
    ],
];

$workflowSteps = [
    [
        'title' => 'Install dependencies',
        'text' => 'Run `composer install` and `npm install` once after cloning the repository.',
    ],
    [
        'title' => 'Build assets',
        'text' => 'Run `npm run build` to compile Sass, add vendor prefixes, and bundle JavaScript.',
    ],
    [
        'title' => 'Render the demo',
        'text' => 'Start a local PHP server or pipe `php index.php` into an HTML file to preview the output.',
    ],
];

$sidebarLinks = [
    ['label' => 'Twig project', 'href' => 'https://twig.symfony.com/'],
    ['label' => 'Original wrapper repository', 'href' => 'https://github.com/voku/twig-wrapper'],
    ['label' => 'Example repository', 'href' => 'https://github.com/voku/twig-wrapper-example'],
];

$globalArray = [
    'language' => 'en',
    'title' => 'Twig Wrapper Example — 2026 refresh',
    'description' => 'A refreshed demo for the original voku Twig wrapper example with modern PHP, Twig, and frontend tooling.',
    'image' => 'images/favicon.ico',
    'site' => '@voku',
    'canonical' => 'https://github.com/voku/twig-wrapper-example',
    'myName' => 'twig-wrapper-example',
];

$twig = new \voku\twig\TwigWrapper('index.twig', [__DIR__], ['cache' => false, 'debug' => true]);
$twig->assign('navigation', $navigation);
$twig->assign('heroSlides', $heroSlides);
$twig->assign('featureCards', $featureCards);
$twig->assign('releaseHighlights', $releaseHighlights);
$twig->assign('workflowSteps', $workflowSteps);
$twig->assign('sidebarLinks', $sidebarLinks);
$twig->assign('globalArray', $globalArray);

echo $twig->render();
