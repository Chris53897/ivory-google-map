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

use Ivory\GoogleMap\Overlay\Polyline;

class PolylineRenderer
{
    /** @var PolylineStyleRenderer */
    private $polylineStyleRenderer;

    /** @var PolylineLocationRenderer */
    private $polylineLocationRenderer;

    public function __construct(
        PolylineStyleRenderer $polylineStyleRenderer,
        PolylineLocationRenderer $polylineLocationRenderer
    ) {
        $this->polylineStyleRenderer    = $polylineStyleRenderer;
        $this->polylineLocationRenderer = $polylineLocationRenderer;
    }

    public function render(Polyline $polyline): string
    {
        $result = [];
        $style  = $this->polylineStyleRenderer->render($polyline);

        if (!empty($style)) {
            $result[] = $style;
        }

        $result[] = $this->polylineLocationRenderer->render($polyline);

        return implode('|', $result);
    }
}
