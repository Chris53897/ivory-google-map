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

use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Ivory\Serializer\Context\ContextInterface;
use Ivory\Serializer\Format;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractSerializableService extends AbstractHttpService
{
    public const FORMAT_JSON = Format::JSON;
    public const FORMAT_XML  = Format::XML;

    /** @var SerializerInterface */
    private $serializer;

    /** @var string */
    private $format = self::FORMAT_JSON;

    public function __construct(
        string $url,
        ClientInterface $client,
        RequestFactoryInterface $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct($url, $client, $messageFactory);

        $this->setSerializer($serializer ?: SerializerBuilder::create());
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    protected function createBaseUrl(RequestInterface $request): string
    {
        return parent::createBaseUrl($request).'/'.$this->format;
    }

    protected function deserialize(ResponseInterface $response, string $type, ContextInterface $context = null)
    {
        return $this->serializer->deserialize((string) $response->getBody(), $type, $this->format, $context);
    }
}
