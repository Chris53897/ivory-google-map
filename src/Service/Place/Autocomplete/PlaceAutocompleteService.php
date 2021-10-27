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

namespace Ivory\GoogleMap\Service\Place\Autocomplete;

use Ivory\GoogleMap\Service\Place\AbstractPlaceSerializableService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;

class PlaceAutocompleteService extends AbstractPlaceSerializableService
{
    public function process(PlaceAutocompleteRequestInterface $request): PlaceAutocompleteResponse
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $response = $this->deserialize(
            $httpResponse,
            PlaceAutocompleteResponse::class,
            (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy())
        );

        $response->setRequest($request);

        return $response;
    }
}
