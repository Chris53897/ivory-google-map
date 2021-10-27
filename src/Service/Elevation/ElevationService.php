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

namespace Ivory\GoogleMap\Service\Elevation;

use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Message\RequestFactoryInterface as MessageFactory;

class ElevationService extends AbstractSerializableService
{
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct('https://maps.googleapis.com/maps/api/elevation', $client, $messageFactory, $serializer);
    }

    public function process(ElevationRequestInterface $request): ElevationResponse
    {
        $httpRequest  = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $response = $this->deserialize($httpResponse, ElevationResponse::class);
        $response->setRequest($request);

        return $response;
    }
}
