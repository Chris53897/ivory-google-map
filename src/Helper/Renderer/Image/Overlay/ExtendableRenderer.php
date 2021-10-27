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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polyline;

class ExtendableRenderer
{
    /** @var CoordinateRenderer */
    private $coordinateRenderer;

    /** @var MarkerLocationRenderer */
    private $markerLocationRenderer;

    /** @var PolylineLocationRenderer */
    private $polylineLocationRenderer;

    public function __construct(
        CoordinateRenderer $coordinateRenderer,
        MarkerLocationRenderer $markerLocationRenderer,
        PolylineLocationRenderer $polylineLocationRenderer
    ) {
        $this->coordinateRenderer = $coordinateRenderer;
        $this->markerLocationRenderer = $markerLocationRenderer;
        $this->polylineLocationRenderer = $polylineLocationRenderer;
    }

    public function render(array $extendables): string
    {
        $result = [];

        foreach ($extendables as $value) {
            if ($value instanceof Coordinate) {
                $result[] = $this->coordinateRenderer->render($value);
            } elseif ($value instanceof Marker) {
                $result[] = $this->markerLocationRenderer->render($value);
            } elseif ($value instanceof Polyline) {
                $result[] = $this->polylineLocationRenderer->render($value);
            } else {
                $result[] = $value;
            }
        }

        return implode('|', $result);
    }
}
