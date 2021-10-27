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

namespace Ivory\GoogleMap\Helper\Renderer\Image\Overlay;

use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Overlay\Marker;

class MarkerLocationRenderer
{
    /** @var CoordinateRenderer */
    private $coordinateRenderer;

    public function __construct(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    public function render(Marker $marker): string
    {
        return $marker->hasStaticOption('location')
            ? $marker->getStaticOption('location')
            : $this->coordinateRenderer->render($marker->getPosition());
    }
}
