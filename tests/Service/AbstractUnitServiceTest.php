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

namespace Ivory\Tests\GoogleMap\Service;

use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractUnitServiceTest extends TestCase
{
    /** @var ClientInterface|MockObject */
    protected $client;

    /** @var RequestFactoryInterface|MockObject */
    protected $messageFactory;

    /** @var SerializerInterface|MockObject */
    protected $serializer;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->client = $this->createHttpClientMock();
        $this->messageFactory = $this->createMessageFactoryMock();
        $this->serializer = $this->createSerializerMock();
    }

    /** @return MockObject|ClientInterface */
    protected function createHttpClientMock()
    {
        return $this->createMock(ClientInterface::class);
    }

    /** @return MockObject|RequestFactoryInterface */
    protected function createMessageFactoryMock()
    {
        return $this->createMock(RequestFactoryInterface::class);
    }

    /** @return MockObject|SerializerInterface */
    protected function createSerializerMock()
    {
        return $this->createMock(SerializerInterface::class);
    }

    /** @return MockObject|RequestInterface */
    protected function createHttpRequestMock()
    {
        return $this->createMock(RequestInterface::class);
    }

    /** @return MockObject|ResponseInterface */
    protected function createHttpResponseMock()
    {
        return $this->createMock(ResponseInterface::class);
    }

    /** @return MockObject|StreamInterface */
    protected function createHttpStreamMock()
    {
        return $this->createMock(StreamInterface::class);
    }

    /** @return MockObject|BusinessAccount */
    protected function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }
}
