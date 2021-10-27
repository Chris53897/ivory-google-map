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

namespace Ivory\GoogleMap\Helper\Subscriber\Image;

use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TypeSubscriber implements EventSubscriberInterface
{
    public function handleMap(StaticMapEvent $event): void
    {
        $map = $event->getMap();

        if ($map->hasStaticOption('maptype')) {
            $type = $map->getStaticOption('maptype');
        } elseif ($map->hasMapOption('mapTypeId')) {
            $type = $map->getMapOption('mapTypeId');
        }

        if (isset($type)) {
            $event->setParameter('maptype', strtolower($type));
        }
    }

    /** {@inheritdoc} */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::TYPE => 'handleMap'];
    }
}
