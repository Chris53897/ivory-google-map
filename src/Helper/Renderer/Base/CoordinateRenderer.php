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

namespace Ivory\GoogleMap\Helper\Renderer\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

class CoordinateRenderer extends AbstractRenderer
{
    public function render(Coordinate $coordinate): string
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectAssignment($coordinate, $formatter->renderObject('LatLng', [
            $coordinate->getLatitude(),
            $coordinate->getLongitude(),
            $formatter->renderEscape($coordinate->isNoWrap()),
        ]));
    }
}
