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

namespace Ivory\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;

class PageTokenPlaceSearchRequest implements PlaceSearchRequestInterface
{
    /** @var PlaceSearchResponse */
    private $response;

    public function __construct(PlaceSearchResponse $response)
    {
        $this->setResponse($response);
    }

    public function getResponse(): PlaceSearchResponse
    {
        return $this->response;
    }

    public function setResponse(PlaceSearchResponse $response): void
    {
        $this->response = $response;
    }

    public function buildContext(): string
    {
        return $this->response->getRequest()->buildContext();
    }

    public function buildQuery(): array
    {
        return ['pagetoken' => $this->response->getNextPageToken()];
    }
}
