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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CenterSubscriber implements EventSubscriberInterface
{
    /** @var CoordinateRenderer */
    private $coordinateRenderer;

    public function __construct(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        $map = $event->getMap();

        if ($map->hasStaticOption('center')) {
            $center = $map->getStaticOption('center');
        } elseif (!$map->isAutoZoom()) {
            $center = $map->getCenter();
        }

        if (isset($center)) {
            if ($center instanceof Coordinate) {
                $center = $this->coordinateRenderer->render($center);
            }

            $event->setParameter('center', $center);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::CENTER => 'handleMap'];
    }
}
