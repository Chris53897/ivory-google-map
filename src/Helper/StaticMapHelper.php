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

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Service\UrlSigner;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class StaticMapHelper extends AbstractHelper
{
    /** @var string|null */
    private $secret;

    /** @var string|null */
    private $clientId;

    /** @var string|null */
    private $channel;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        ?string $secret = null,
        ?string $clientId = null,
        ?string $channel = null
    ) {
        parent::__construct($eventDispatcher);

        $this->secret   = $secret;
        $this->clientId = $clientId;
        $this->channel  = $channel;
    }

    public function hasSecret(): bool
    {
        return null !== $this->secret;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }

    public function hasClientId(): bool
    {
        return null !== $this->clientId;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function hasChannel(): bool
    {
        return null !== $this->channel;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

    public function render(Map $map): string
    {
        $this->getEventDispatcher()->dispatch($event = new StaticMapEvent($map), StaticMapEvents::HTML);

        $query = preg_replace('/(%5B[0-9]+%5D)+=/', '=', http_build_query($event->getParameters(), '', '&'));
        $url   = 'https://maps.googleapis.com/maps/api/staticmap?'.$query;

        if ($this->hasSecret()) {
            $url = UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
        }

        return $url;
    }
}
