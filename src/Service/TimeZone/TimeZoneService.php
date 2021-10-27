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

namespace Ivory\GoogleMap\Service\TimeZone;

use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Message\RequestFactoryInterface as MessageFactory;

class TimeZoneService extends AbstractSerializableService
{
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct('https://maps.googleapis.com/maps/api/timezone', $client, $messageFactory, $serializer);
    }

    public function process(TimeZoneRequestInterface $request): TimeZoneResponse
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $context = new Context();

        if (self::FORMAT_XML === $this->getFormat()) {
            $context->setNamingStrategy(new SnakeCaseNamingStrategy());
        }

        $response = $this->deserialize($httpResponse, TimeZoneResponse::class, $context);
        $response->setRequest($request);

        return $response;
    }
}
