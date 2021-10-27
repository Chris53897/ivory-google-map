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

class JavascriptTagRenderer extends AbstractTagRenderer
{
    /** @param string[] $attributes */
    public function render(string $code = null, array $attributes = [], bool $newLine = true): string
    {
        return $this->getTagRenderer()->render(
            'script',
            $code,
            array_merge(['type' => 'text/javascript'], $attributes),
            $newLine
        );
    }
}
