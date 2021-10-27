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

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\ApiRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;

class ApiJavascriptSubscriber extends AbstractDelegateSubscriber
{
    /** @var ApiRenderer */
    private $apiRenderer;

    /** @var JavascriptTagRenderer */
    private $javascriptTagRenderer;

    public function __construct(
        Formatter $formatter,
        ApiRenderer $apiRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setApiRenderer($apiRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    public function getApiRenderer(): ApiRenderer
    {
        return $this->apiRenderer;
    }

    public function setApiRenderer(ApiRenderer $apiRenderer): void
    {
        $this->apiRenderer = $apiRenderer;
    }

    public function getJavascriptTagRenderer(): JavascriptTagRenderer
    {
        return $this->javascriptTagRenderer;
    }

    public function setJavascriptTagRenderer(JavascriptTagRenderer $javascriptTagRenderer): void
    {
        $this->javascriptTagRenderer = $javascriptTagRenderer;
    }

    public function handle(Event $event, string $eventName, EventDispatcherInterface $eventDispatcher): void
    {
        parent::handle($event, $eventName, $eventDispatcher);

        if ($event instanceof ApiEvent) {
            $this->handleApi($event);
        }
    }

    /** @return string[][] */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            ApiEvents::JAVASCRIPT => [
                ApiEvents::JAVASCRIPT_MAP,
                ApiEvents::JAVASCRIPT_AUTOCOMPLETE,
            ],
        ];
    }

    private function handleApi(ApiEvent $event)
    {
        $event->setCode($this->getJavascriptTagRenderer()->render($this->getApiRenderer()->render(
            $event->getCallbacks(),
            $event->getRequirements(),
            $event->getSources(),
            $event->getLibraries()
        )));
    }
}
