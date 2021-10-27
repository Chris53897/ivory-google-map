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

namespace Ivory\GoogleMap\Helper\Subscriber\Place;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;
use Ivory\GoogleMap\Place\Autocomplete;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AutocompleteJavascriptSubscriber extends AbstractDelegateSubscriber
{
    /** @var AutocompleteRenderer */
    private $autocompleteRenderer;

    /** @var CallbackRenderer */
    private $callbackRenderer;

    /** @var JavascriptTagRenderer */
    private $javascriptTagRenderer;

    public function __construct(
        Formatter $formatter,
        AutocompleteRenderer $autocompleteRenderer,
        CallbackRenderer $callbackRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setAutocompleteRenderer($autocompleteRenderer);
        $this->setCallbackRenderer($callbackRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    public function getAutocompleteRenderer(): AutocompleteRenderer
    {
        return $this->autocompleteRenderer;
    }

    public function setAutocompleteRenderer(AutocompleteRenderer $autocompleteRenderer): void
    {
        $this->autocompleteRenderer = $autocompleteRenderer;
    }

    public function getCallbackRenderer(): CallbackRenderer
    {
        return $this->callbackRenderer;
    }

    public function setCallbackRenderer(CallbackRenderer $callbackRenderer): void
    {
        $this->callbackRenderer = $callbackRenderer;
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
        } elseif ($event instanceof PlaceAutocompleteEvent) {
            $this->handleAutocomplete($event);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            ApiEvents::JAVASCRIPT_AUTOCOMPLETE  => [],
            PlaceAutocompleteEvents::JAVASCRIPT => [
                PlaceAutocompleteEvents::JAVASCRIPT_INIT,
                PlaceAutocompleteEvents::JAVASCRIPT_BASE,
                PlaceAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE,
                PlaceAutocompleteEvents::JAVASCRIPT_EVENT,
            ],
        ];
    }

    private function handleApi(ApiEvent $event): void
    {
        foreach ($event->getObjects(Autocomplete::class) as $autocomplete) {
            $event->addLibraries(array_unique(array_merge($autocomplete->getLibraries(), ['places'])));
            $event->addCallback($autocomplete, $this->renderCallback($autocomplete));
            $event->addRequirement($autocomplete, $this->autocompleteRenderer->renderRequirement());
        }
    }

    private function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();

        $event->setCode($this->javascriptTagRenderer->render($formatter->renderClosure(
            $event->getCode(),
            [],
            $this->renderCallback($event->getAutocomplete())
        )));
    }

    private function renderCallback(Autocomplete $autocomplete): string
    {
        return $this->callbackRenderer->render($autocomplete->getVariable());
    }
}
