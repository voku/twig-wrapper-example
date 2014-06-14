<?php

require_once __DIR__ . '/inc_globals.php';

// ---------------------------------------------------------------------------------------

$menu = '
<ul class="nav navbar-nav">
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Demo <span class="caret"></span></a>
    <ul class="dropdown-menu" aria-labelledby="home">
      <li><a href="#">Home</a></li>
      <li class="divider"></li>
      <li><a href="#">foo</a></li>
      <li><a href="#">bar</a></li>
      <li><a href="#">lall</a></li>
    </ul>
  </li>
  <li>
    <a target="_blank" href="http://suckup.de">Blog</a>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
    <ul class="dropdown-menu" aria-labelledby="download">
      <li><a href="css/app.css">app.css</a></li>
      <li><a href="css-min/app.css">app.css (min)</a></li>
      <li class="divider"></li>
      <li><a href="scss/app.scss">app.scss</a></li>
    </ul>
  </li>
</ul>
';

$testTextArray['text'] = array(
  'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.',
  'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.',
  'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.',
);

$testTextArray['headline'] = array(
  'Example headline',
  'Example headline',
  'Example headline',
);

// ---------------------------------------------------------------------------------------

$twig = new \voku\twig\TwigWrapper('index.twig', array(__DIR__), array('cache' => false));

$twig->assign('testTextArray', $testTextArray);
$twig->assign('bootstrap_menu', $menu);

echo $twig->render();