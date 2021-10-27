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

namespace Ivory\GoogleMap\Service;

class BusinessAccount
{
    /** @var string */
    private $clientId;

    /** @var string */
    private $secret;

    /** @var string */
    private $channel;

    public function __construct(string $clientId, string $secret, ?string $channel = null)
    {
        $this->clientId = $clientId;
        $this->secret   = $secret;
        $this->channel  = $channel;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    public function hasChannel(): bool
    {
        return null !== $this->channel;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(?string $channel = null): void
    {
        $this->channel = $channel;
    }

    public function signUrl(string $url): string
    {
        return UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
    }
}
