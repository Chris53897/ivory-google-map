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

class KeySubscriber implements EventSubscriberInterface
{
    /** @var string|null */
    private $key;

    /** @param string|null $key */
    public function __construct($key = null)
    {
        $this->key = $key;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        if (null !== $this->key) {
            $event->setParameter('key', $this->key);
        }
    }

    /** {@inheritdoc} */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::KEY => 'handleMap'];
    }
}
