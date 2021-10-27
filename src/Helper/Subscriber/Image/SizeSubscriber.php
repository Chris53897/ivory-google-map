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
use Ivory\GoogleMap\Helper\Renderer\Image\SizeRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SizeSubscriber implements EventSubscriberInterface
{
    /** @var SizeRenderer */
    private $sizeRenderer;

    public function __construct(SizeRenderer $sizeRenderer)
    {
        $this->sizeRenderer = $sizeRenderer;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        $event->setParameter('size', $this->sizeRenderer->render($event->getMap()));
    }

    /** {@inheritdoc} */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::SIZE => 'handleMap'];
    }
}
