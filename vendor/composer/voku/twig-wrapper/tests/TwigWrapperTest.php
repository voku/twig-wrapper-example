<?php

use voku\twig\TwigWrapper;

class TwigWrapperTest extends PHPUnit_Framework_TestCase
{

  function test_assign()
  {
    $twig = new TwigWrapper('test.twig', array(__DIR__), array('cache' => false));

    $twig->assign('test', 'testing-öäü');

    $this->assertEquals('<h1>testing-öäü</h1>', $twig->render(false));
  }

}
