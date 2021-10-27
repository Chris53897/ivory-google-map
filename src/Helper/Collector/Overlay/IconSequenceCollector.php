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
use Ivory\GoogleMap\Overlay\IconSequence;

class IconSequenceCollector extends AbstractCollector
{
    /** @var PolylineCollector */
    private $polylineCollector;

    public function __construct(PolylineCollector $polylineCollector)
    {
        $this->setPolylineCollector($polylineCollector);
    }

    public function getPolylineCollector(): PolylineCollector
    {
        return $this->polylineCollector;
    }

    public function setPolylineCollector(PolylineCollector $polylineCollector): void
    {
        $this->polylineCollector = $polylineCollector;
    }

    /**
     * @param IconSequence[] $icons
     *
     * @return IconSequence[]
     */
    public function collect(Map $map, array $icons = []): array
    {
        foreach ($this->polylineCollector->collect($map) as $polyline) {
            if ($polyline->hasIconSequences()) {
                $icons = $this->collectValues($polyline->getIconSequences());
            }
        }

        return $icons;
    }
}
