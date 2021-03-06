<?php

namespace voku\twig;

/**
 * Refreshing modified Templates when APC is enabled and apc.stat = 0
 *
 * source: http://twig.sensiolabs.org/doc/recipes.html
 */
class Environment extends \Twig_Environment
{

  /**
   * write apc-cache()
   *
   * @param $file
   * @param $content
   */
  protected function writeCacheFile($file, $content)
  {
    parent::writeCacheFile($file, $content);

    // Compile cached-file into bytecode-cache
    if (function_exists('apc_compile_file') === true) {
      apc_compile_file($file);
    }
  }
}