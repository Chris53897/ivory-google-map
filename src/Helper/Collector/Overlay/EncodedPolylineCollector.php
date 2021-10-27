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

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

class EncodedPolylineCollector extends AbstractCollector
{
    /**
     * @param EncodedPolyline[] $encodedPolylines
     *
     * @return EncodedPolyline[]
     */
    public function collect(Map $map, array $encodedPolylines = []): array
    {
        return $this->collectValues($map->getOverlayManager()->getEncodedPolylines(), $encodedPolylines);
    }
}
