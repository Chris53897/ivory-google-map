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
use Ivory\GoogleMap\Overlay\ExtendableInterface;

class ExtendableCollector extends AbstractCollector
{
    /**
     * @param ExtendableInterface[] $extendables
     *
     * @return ExtendableInterface[]
     */
    public function collect(Map $map, array $extendables = []): array
    {
        return $this->collectValues($map->getBound()->getExtendables(), $extendables);
    }
}
