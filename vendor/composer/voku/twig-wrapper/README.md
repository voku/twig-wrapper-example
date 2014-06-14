[![Build Status](https://travis-ci.org/voku/twig-wrapper.png?branch=master)](https://travis-ci.org/voku/twig-wrapper)

# Twig Wrapper is a wrapper class for the Twig templating system.

http://www.twig-project.org/

Use:

```php
<?php

$twig = new \voku\twig\TwigWrapper('index.twig', array(__DIR__));
$twig->assign('name', 'data');
echo $twig->render();

?>
```


