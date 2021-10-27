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

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

class StylesheetRenderer extends AbstractRenderer
{
    public function render(string $stylesheet, string $value): string
    {
        $formatter = $this->getFormatter();

        return $formatter->renderCode($stylesheet.':'.$formatter->renderSeparator().$value, true, false);
    }
}
