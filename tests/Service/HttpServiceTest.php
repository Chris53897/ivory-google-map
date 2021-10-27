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

use Ivory\GoogleMap\Service\AbstractHttpService;
use Ivory\GoogleMap\Service\AbstractService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class HttpServiceTest extends TestCase
{
    /** @var AbstractHttpService|MockObject */
    private $service;

    /** @var string */
    private $url;

    /** @var ClientInterface|MockObject */
    private $client;

    /** @var RequestFactoryInterface|MockObject */
    private $messageFactory;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->service = $this->getMockBuilder(AbstractHttpService::class)
            ->setConstructorArgs([
                $this->url = 'https://foo',
                $this->client = $this->createHttpClientMock(),
                $this->messageFactory = $this->createMessageFactoryMock(),
            ])
            ->getMockForAbstractClass();
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(AbstractService::class, $this->service);
        $this->assertSame('https://foo', $this->service->getUrl());
        $this->assertSame($this->client, $this->service->getClient());
        $this->assertSame($this->messageFactory, $this->service->getMessageFactory());
    }

    public function testClient()
    {
        $this->service->setClient($client = $this->createHttpClientMock());

        $this->assertSame($client, $this->service->getClient());
    }

    public function testMessageFactory()
    {
        $this->service->setMessageFactory($messageFactory = $this->createMessageFactoryMock());

        $this->assertSame($messageFactory, $this->service->getMessageFactory());
    }

    /** @return MockObject|ClientInterface */
    private function createHttpClientMock()
    {
        return $this->createMock(ClientInterface::class);
    }

    /** @return MockObject|RequestFactoryInterface */
    private function createMessageFactoryMock()
    {
        return $this->createMock(RequestFactoryInterface::class);
    }
}
