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

namespace Ivory\GoogleMap\Helper\Collector\Base;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;

class PointCollector extends AbstractCollector
{
    /** @var MarkerCollector */
    private $markerCollector;

    public function __construct(MarkerCollector $markerCollector)
    {
        $this->setMarkerCollector($markerCollector);
    }

    public function getMarkerCollector(): MarkerCollector
    {
        return $this->markerCollector;
    }

    public function setMarkerCollector(MarkerCollector $markerCollector): void
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @param Point[] $points
     *
     * @return Point[]
     */
    public function collect(Map $map, array $points = []): array
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasIcon()) {
                $icon = $marker->getIcon();

                if ($icon->hasAnchor()) {
                    $points = $this->collectValue($icon->getAnchor(), $points);
                }

                if ($icon->hasOrigin()) {
                    $points = $this->collectValue($icon->getOrigin(), $points);
                }

                if ($icon->hasLabelOrigin()) {
                    $points = $this->collectValue($icon->getLabelOrigin(), $points);
                }
            }
        }

        return $points;
    }
}
