<?php

namespace voku\twig;

use Twig_Extension_Debug;
use Twig_Extension_Optimizer;
use Twig_Loader_Filesystem;
use Twig_NodeVisitor_Optimizer;

/**
 * TwigWrapper: this is a wrapper for twig ...
 */
class TwigWrapper
{
  protected $loader;
  protected $twig;
  protected $template;
  protected $templatePath;
  protected $environment;
  protected $filename;
  protected $data;

  /**
   * TwigWrapper
   *
   * @param string $filename
   * @param array|string $templatePath
   * @param string $environment
   */
  public function __construct($filename = '', $templatePath = array(), $environment = '')
  {
    // set template-path
    $this->setTemplatePath($templatePath);

    // set the environment-config
    $this->setEnvironment($environment);

    $this->loader = new Twig_Loader_Filesystem(
       $this->templatePath
    );
    $this->twig = new Environment($this->loader, $this->environment);

    // add debug-extension only for dev
    //$this->twig->addExtension(new Twig_Extension_Debug());

    // set the optimizer-level
    $this->optimizer();

    // add html-extension
    $this->twig->addExtension(new PluginHtml());

    // TODO: only for dev
    $this->twig->addExtension(new Twig_Extension_Debug());

    if ($filename) {
      $this->filename = $filename;
    }

    // clear twig-cache
    $this->clearTwigCache();

    // clear twig-data-array
    $this->data = array();

    $this->loadData();
  }

  /**
   * set the template-path or use the path from config
   *
   * @param array|string $templatePath
   *
   * @return bool
   */
  private function setTemplatePath($templatePath)
  {
    $return = false;

    if (is_string($templatePath)) {
      if ($this->checkTemplatePath($templatePath) === true) {
        $this->templatePath[] = $templatePath;

        $return = true;
      }
    }
    else if (is_array($templatePath)) {
      foreach ($templatePath as $path) {
        if ($this->checkTemplatePath($path) === true) {
          $this->templatePath[] = $path;

          $return = true;
        }
      }
    }

    return $return;
  }

  /**
   * check if the the template-directory exists
   *
   * @param string $templatePath
   * @param bool   $exitOnError
   *
   * @return bool
   */
  private function checkTemplatePath($templatePath, $exitOnError = true)
  {
    if (!is_dir($templatePath)) {

      if ($exitOnError === true) {
        exit();
      }

      return false;
    } else {
      return true;
    }
  }

  /**
   * set the environment-config
   *
   * @param $environment
   */
  private function setEnvironment($environment)
  {
    if (!$environment) {
      // set environment (twig-settings)
      $environment = array('cache' => 'cache/');
    }

    $this->environment = $environment;
  }

  /**
   * optimize twig-output
   *
   * OPTIMIZE_ALL (-1) | OPTIMIZE_NONE (0) | OPTIMIZE_FOR (2) | OPTIMIZE_RAW_FILTER (4) | OPTIMIZE_VAR_ACCESS (8)
   *
   */
  private function optimizer()
  {
    $optimizeOption = -1;

    if ($this->environment['cache'] === false) {
      $optimizeOption = 2;
    }

    switch ($optimizeOption) {
      case -1:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_ALL;
        break;

      case 0:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_NONE;
        break;

      case 2:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_FOR;
        break;

      case 4:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_RAW_FILTER;
        break;

      case 8:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_VAR_ACCESS;
        break;

      default:
        $nodeVisitorOptimizer = Twig_NodeVisitor_Optimizer::OPTIMIZE_ALL;
        break;
    }

    $optimizer = new Twig_Extension_Optimizer($nodeVisitorOptimizer);
    $this->twig->addExtension($optimizer);
  }

  /**
   * clear TwigWrapper-Cache && exit()
   */
  public function clearTwigCache()
  {
    if (isset($_GET['clearTwigCache']) && $_GET['clearTwigCache'] == 1)
    {
      $this->twig->clearCacheFiles();
      echo "twig-cache cleared!";
      exit();
    }
  }

  /**
   * loads default-data into TwigWrapper
   */
  public function loadData()
  {
    // TODO: load extra data e.g. from DB
  }

  /**
   * assign values to variables
   *
   * @param string $key
   * @param mixed  $value
   */
  public function assign($key, $value)
  {
    $this->data[$key] = $value;
  }

  /**
   * render the template
   * 
   * @param bool $withHeader
   *
   * @return string
   */
  public function render($withHeader = true)
  {
    // DEBUG
    if (isset($_GET['twigDebug']) && $_GET['twigDebug'] == 1) {
      $this->debug();
    }

    $this->template = $this->twig->loadTemplate($this->filename);

    if ($withHeader === true) {
      header('X-UA-Compatible: IE=edge,chrome=1');
      header('Content-Type: text/html; charset=utf-8');
    }

    return $this->template->render($this->data);
  }

  /**
   * debug
   */
  public function debug()
  {
    var_dump($this);
    exit();
  }

  /**
   * show all variables
   */
  public function debug_data()
  {
    var_dump($this->data);
    exit();
  }

  /**
   * set filename
   *
   * @param string $filename
   */
  public function setFilename($filename)
  {
    $this->filename = $filename;
  }
}
