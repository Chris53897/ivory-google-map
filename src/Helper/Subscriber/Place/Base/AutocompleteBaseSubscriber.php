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

namespace Ivory\GoogleMap\Helper\Subscriber\Place\Base;

use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

class AutocompleteBaseSubscriber extends AbstractDelegateSubscriber
{
    /** {@inheritdoc} */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            PlaceAutocompleteEvents::JAVASCRIPT_BASE => [
                PlaceAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE,
                PlaceAutocompleteEvents::JAVASCRIPT_BASE_BOUND,
            ],
        ];
    }
}
