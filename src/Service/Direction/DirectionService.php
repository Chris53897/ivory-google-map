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

namespace Ivory\GoogleMap\Service\Direction;

use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;
use Ivory\GoogleMap\Service\Direction\Response\DirectionResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class DirectionService extends AbstractSerializableService
{
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct('https://maps.googleapis.com/maps/api/directions', $client, $messageFactory, $serializer);
    }

    public function route(DirectionRequestInterface $request): DirectionResponse
    {
        $httpRequest  = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $response = $this->deserialize(
            $httpResponse,
            DirectionResponse::class,
            (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy())
        );

        $response->setRequest($request);

        return $response;
    }
}
