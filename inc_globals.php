<?php

declare(strict_types=1);

$autoloadFile = __DIR__ . '/vendor/composer/autoload.php';

if (!is_file($autoloadFile)) {
    throw new RuntimeException('Composer dependencies are missing. Run "composer install" first.');
}

require_once $autoloadFile;
