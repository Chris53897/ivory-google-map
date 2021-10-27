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

namespace Ivory\GoogleMap\Service\Place\Detail;

use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Message\RequestFactoryInterface as MessageFactory;

class PlaceDetailService extends AbstractSerializableService
{
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct(
            'https://maps.googleapis.com/maps/api/place/details',
            $client,
            $messageFactory,
            $serializer
        );
    }

    public function process(PlaceDetailRequestInterface $request): PlaceDetailResponse
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $response = $this->deserialize(
            $httpResponse,
            PlaceDetailResponse::class,
            (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy())
        );

        $response->setRequest($request);

        return $response;
    }
}
