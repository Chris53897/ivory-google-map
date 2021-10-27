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

namespace Ivory\GoogleMap\Helper\Collector\Place\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Place\Autocomplete;

class AutocompleteEventOnceCollector extends AbstractCollector
{
    /**
     * @param Event[] $eventsOnce
     *
     * @return Event[]
     */
    public function collect(Autocomplete $autocomplete, array $eventsOnce = []): array
    {
        return $this->collectValues($autocomplete->getEventManager()->getEventsOnce(), $eventsOnce);
    }
}
