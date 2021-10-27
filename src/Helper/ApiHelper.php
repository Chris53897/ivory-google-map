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

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;

class ApiHelper extends AbstractHelper
{
    public function render(array $objects): string
    {
        $this->getEventDispatcher()->dispatch($event = new ApiEvent($objects), ApiEvents::JAVASCRIPT);

        return $event->getCode();
    }
}
