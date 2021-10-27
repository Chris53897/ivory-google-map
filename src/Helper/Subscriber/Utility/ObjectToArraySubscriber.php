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

namespace Ivory\GoogleMap\Helper\Subscriber\Utility;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Utility\ObjectToArrayRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

class ObjectToArraySubscriber extends AbstractSubscriber
{
    /** @var ObjectToArrayRenderer */
    private $objectToArrayRenderer;

    public function __construct(Formatter $formatter, ObjectToArrayRenderer $objectToArrayRenderer)
    {
        parent::__construct($formatter);

        $this->setObjectToArrayRenderer($objectToArrayRenderer);
    }

    public function getObjectToArrayRenderer(): ObjectToArrayRenderer
    {
        return $this->objectToArrayRenderer;
    }

    public function setObjectToArrayRenderer(ObjectToArrayRenderer $objectToArrayRenderer): void
    {
        $this->objectToArrayRenderer = $objectToArrayRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $event->getMap(),
            $this->objectToArrayRenderer->render(),
            'functions.to_array'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_INIT_FUNCTION => 'handleMap'];
    }
}
