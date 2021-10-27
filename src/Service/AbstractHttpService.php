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

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

abstract class AbstractHttpService extends AbstractService
{
    /** @var ClientInterface */
    private $client;

    /** @var RequestFactoryInterface */
    private $messageFactory;

    public function __construct(string $url, ClientInterface $client, RequestFactoryInterface $messageFactory)
    {
        parent::__construct($url);

        $this->client         = $client;
        $this->messageFactory = $messageFactory;
    }

    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    public function getMessageFactory(): RequestFactoryInterface
    {
        return $this->messageFactory;
    }

    public function setMessageFactory(RequestFactoryInterface $messageFactory): void
    {
        $this->messageFactory = $messageFactory;
    }

    protected function createRequest(\Ivory\GoogleMap\Service\RequestInterface $request): RequestInterface
    {
        return $this->messageFactory->createRequest('GET', $this->createUrl($request));
    }
}
