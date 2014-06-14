<?php

namespace voku\twig;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

/**
 * TwigWrapper-Plugins for Html-Helpers
 */
class PluginHtml extends Twig_Extension
{

  /**
   * __construct()
   */
  public function __construct()
  {
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctions()
  {
    return array(
        new Twig_SimpleFunction(
            'getHtmljQuery', array(
                $this,
                'getHtmljQuery'
            )
        )
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFilters()
  {
    return array(
        new Twig_SimpleFilter(
            'lettering', array(
                $this,
                'lettering'
            )
        )
    );
  }

  /**
   * get jQuery
   *
   * @param string $localPath
   * @param string $jQueryVersion
   *
   * @return string
   */
  public function getHtmljQuery($localPath, $jQueryVersion = '2.1.0')
  {
    $html = '
    <script src="//ajax.googleapis.com/ajax/libs/jquery/' . $jQueryVersion . '/jquery.js"></script>
    <script>
      if (typeof jQuery == \'undefined\') {
        document.write(unescape("%3Cscript src=\'' . $localPath. '\' type=\'text/javascript\'%3E%3C/script%3E"));
      }
    </script>
    ';

    return $html;
  }

  /**
   * a port of "Lettering.js" in php
   *
   * @param $str
   *
   * @return string
   */
  public function lettering($str)
  {
    $output = '';
    $array = str_split($str);
    $idx = 1;

    foreach ($array as $letter) {
      $output .= '<span class="char' . $idx++ . '">' . $letter . '</span>';
    }

    return $output;
  }


  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName()
  {
    return 'twig_plugin_Html';
  }
}