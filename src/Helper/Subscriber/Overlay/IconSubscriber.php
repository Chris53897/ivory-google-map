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

use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

class IconSubscriber extends AbstractSubscriber
{
    /** @var IconCollector */
    private $iconCollector;

    /** @var IconRenderer */
    private $iconRenderer;

    public function __construct(
        Formatter $formatter,
        IconCollector $iconCollector,
        IconRenderer $iconRenderer
    ) {
        parent::__construct($formatter);

        $this->setIconCollector($iconCollector);
        $this->setIconRenderer($iconRenderer);
    }

    public function getIconCollector(): IconCollector
    {
        return $this->iconCollector;
    }

    public function setIconCollector(IconCollector $iconCollector): void
    {
        $this->iconCollector = $iconCollector;
    }

    public function getIconRenderer(): IconRenderer
    {
        return $this->iconRenderer;
    }

    public function setIconRenderer(IconRenderer $iconRenderer): void
    {
        $this->iconRenderer = $iconRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getIconCollector()->collect($map) as $icon) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->iconRenderer->render($icon),
                'overlays.icons',
                $icon
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_ICON => 'handleMap'];
    }
}
