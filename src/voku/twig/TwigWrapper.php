<?php

declare(strict_types=1);

namespace voku\twig;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

final class TwigWrapper
{
    private array $data = [];
    private array $environment;
    private string $filename = '';
    private array $templatePath = [];
    private Environment $twig;

    /**
     * @param array<int, string>|string $templatePath
     * @param array<string, mixed>|string $environment
     */
    public function __construct(string $filename = '', array|string $templatePath = [], array|string $environment = '')
    {
        $this->setTemplatePath($templatePath);
        $this->setEnvironment($environment);

        $loader = new FilesystemLoader($this->templatePath);
        $this->twig = new Environment($loader, $this->environment);
        $this->twig->addExtension(new PluginHtml());
        $this->twig->addExtension(new DebugExtension());

        if ($filename !== '') {
            $this->filename = $filename;
        }

        $this->clearTwigCache();
        $this->loadData();
    }

    public function clearTwigCache(): void
    {
        if (isset($_GET['clearTwigCache']) && (string) $_GET['clearTwigCache'] === '1' && method_exists($this->twig, 'clearCacheFiles')) {
            $this->twig->clearCacheFiles();
            echo 'twig-cache cleared!';
            exit;
        }
    }

    public function loadData(): void
    {
    }

    public function assign(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function render(bool $withHeader = true): string
    {
        if (isset($_GET['twigDebug']) && (string) $_GET['twigDebug'] === '1') {
            $this->debug();
        }

        if ($withHeader) {
            header('X-UA-Compatible: IE=edge');
            header('Content-Type: text/html; charset=utf-8');
        }

        return $this->twig->render($this->filename, $this->data);
    }

    public function debug(): never
    {
        var_dump($this);
        exit;
    }

    public function debug_data(): never
    {
        var_dump($this->data);
        exit;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @param array<int, string>|string $templatePath
     */
    private function setTemplatePath(array|string $templatePath): void
    {
        $paths = is_array($templatePath) ? $templatePath : [$templatePath];

        foreach ($paths as $path) {
            if (!is_string($path) || $path === '' || !is_dir($path)) {
                continue;
            }

            $this->templatePath[] = $path;
        }

        if ($this->templatePath === []) {
            throw new \InvalidArgumentException('At least one valid template path is required.');
        }
    }

    /**
     * @param array<string, mixed>|string $environment
     */
    private function setEnvironment(array|string $environment): void
    {
        if (!is_array($environment)) {
            $environment = ['cache' => __DIR__ . '/../../../cache/twig'];
        }

        $this->environment = $environment;
    }
}
