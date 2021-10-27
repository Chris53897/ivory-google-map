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

namespace Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

class PositionExtendableRenderer extends AbstractRenderer implements ExtendableRendererInterface
{
    public function render(ExtendableInterface $extendable, Bound $bound): string
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectCall($bound, 'extend', [
            $formatter->renderObjectCall($extendable, 'getPosition'),
        ]);
    }
}
