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

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Overlay\IconSequence;

class IconSequenceRenderer extends AbstractJsonRenderer
{
    public function render(IconSequence $icon): string
    {
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[icon]', $icon->getSymbol()->getVariable(), false)
            ->setValues($icon->getOptions());

        return $this->getFormatter()->renderObjectAssignment($icon, $jsonBuilder->build());
    }
}
