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

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Overlay\MarkerClusterType;

class MarkerSubscriber extends AbstractMarkerSubscriber
{
    /** @var MarkerRenderer */
    private $markerRenderer;

    public function __construct(
        Formatter $formatter,
        MarkerCollector $markerCollector,
        MarkerRenderer $markerRenderer
    ) {
        parent::__construct($formatter, $markerCollector);

        $this->setMarkerRenderer($markerRenderer);
    }

    public function getMarkerRenderer(): MarkerRenderer
    {
        return $this->markerRenderer;
    }

    public function setMarkerRenderer(MarkerRenderer $markerRenderer): void
    {
        $this->markerRenderer = $markerRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();
        $markerMap = null;

        if (MarkerClusterType::DEFAULT_ === $map->getOverlayManager()->getMarkerCluster()->getType()) {
            $markerMap = $map;
        }

        foreach ($this->getMarkerCollector()->collect($map) as $marker) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->markerRenderer->render($marker, $markerMap),
                'overlays.markers',
                $marker
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_MARKER => 'handleMap'];
    }
}
