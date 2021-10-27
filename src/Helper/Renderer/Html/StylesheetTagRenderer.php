<?php

declare(strict_types=1);

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;

class StylesheetTagRenderer extends AbstractTagRenderer
{
    /** @var StylesheetRenderer */
    private $stylesheetRenderer;

    public function __construct(Formatter $formatter, TagRenderer $tagRenderer, StylesheetRenderer $stylesheetRenderer)
    {
        parent::__construct($formatter, $tagRenderer);

        $this->setStylesheetRenderer($stylesheetRenderer);
    }

    public function getStylesheetRenderer(): StylesheetRenderer
    {
        return $this->stylesheetRenderer;
    }

    public function setStylesheetRenderer(StylesheetRenderer $stylesheetRenderer): void
    {
        $this->stylesheetRenderer = $stylesheetRenderer;
    }

    /**
     * @param string[] $stylesheets
     * @param string[] $attributes
     */
    public function render(string $name, array $stylesheets, array $attributes = [], bool $newLine = true): string
    {
        $formatter = $this->getFormatter();

        $tagStylesheets = [];
        foreach ($stylesheets as $stylesheet => $value) {
            $tagStylesheets[] = $this->stylesheetRenderer->render($stylesheet, $value);
        }

        return $this->getTagRenderer()->render(
            'style',
            $formatter->renderLines([
                $name.$formatter->renderSeparator().'{',
                $formatter->renderIndentation($formatter->renderLines($tagStylesheets, true, false)),
                '}',
            ], !empty($tagStylesheets), false),
            array_merge(['type' => 'text/css'], $attributes),
            $newLine
        );
    }
}
