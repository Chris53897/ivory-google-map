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

namespace Ivory\GoogleMap\Helper\Subscriber\Control;

use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

class ControlSubscriber extends AbstractDelegateSubscriber
{
    /** {@inheritdoc} */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_CONTROL => [
                MapEvents::JAVASCRIPT_CONTROL_CUSTOM,
            ],
        ];
    }
}
