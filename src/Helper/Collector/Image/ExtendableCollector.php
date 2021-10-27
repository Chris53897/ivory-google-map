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

namespace Ivory\GoogleMap\Helper\Collector\Image;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polyline;

class ExtendableCollector extends AbstractCollector
{
    /**
     * @param ExtendableInterface[] $extendables
     *
     * @return ExtendableInterface[]
     */
    public function collect(Map $map, array $extendables = []): array
    {
        foreach ($map->getBound()->getExtendables() as $extendable) {
            if ($extendable instanceof Marker || $extendable instanceof Polyline) {
                $extendables = $this->collectValue($extendable, $extendables);
            }
        }

        return $extendables;
    }
}
