<?php
namespace App\library\BlogFram;

class TwigMyExtension extends \Twig\Extension\AbstractExtension
{

    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('markdown', [$this, 'markdown'], ['is_safe'=>['html']]),
        ];
    }

    public function markdown($value)
    {
        return \Michelf\MarkdownExtra::defaultTransform($value);
    }

}