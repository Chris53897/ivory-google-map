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

use Ivory\GoogleMap\Overlay\EncodedPolyline;

class EncodedPolylineStyleRenderer extends AbstractPolylineStyleRenderer
{
    public function render(EncodedPolyline $encodedPolyline): string
    {
        return $this->renderPolylineStyle(
            $encodedPolyline->hasStaticOption('styles') ? $encodedPolyline->getStaticOption('styles') : [],
            $encodedPolyline
        );
    }
}
