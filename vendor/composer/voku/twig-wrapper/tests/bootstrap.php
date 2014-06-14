<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

if (is_file(dirname(__DIR__) . '/src/voku/twig/TwigWrapper.php')) {
  require_once dirname(__DIR__) . '/src/voku/twig/TwigWrapper.php';
  require_once dirname(__DIR__) . '/src/voku/twig/Environment.php';
  require_once dirname(__DIR__) . '/src/voku/twig/PluginHtml.php';
}

