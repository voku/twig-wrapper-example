<?php

declare(strict_types=1);

namespace voku\twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class PluginHtml extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getHtmljQuery', [$this, 'getHtmljQuery'], ['is_safe' => ['html']]),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('lettering', [$this, 'lettering'], ['is_safe' => ['html']]),
        ];
    }

    public function getHtmljQuery(string $localPath, string $jQueryVersion = '3.7.1'): string
    {
        return sprintf(
            "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/%s/jquery.min.js\"></script>\n<script>window.jQuery||document.write('<script src=\"%s\"><\\/script>')</script>",
            htmlspecialchars($jQueryVersion, ENT_QUOTES),
            htmlspecialchars($localPath, ENT_QUOTES)
        );
    }

    public function lettering(string $value): string
    {
        $characters = mb_str_split($value);
        $output = '';

        foreach ($characters as $index => $character) {
            $output .= sprintf('<span class="char%d">%s</span>', $index + 1, htmlspecialchars($character, ENT_QUOTES));
        }

        return $output;
    }
}
