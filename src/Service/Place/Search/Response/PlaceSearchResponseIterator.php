<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Response;

use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Place\Search\Request\PageTokenPlaceSearchRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchResponseIterator implements \Iterator
{
    /**
     * @var PlaceSearchService
     */
    private $service;

    /**
     * @var PlaceSearchResponse[]
     */
    private $responses = [];

    /**
     * @var int
     */
    private $position = 0;

    public function __construct(PlaceSearchService $service, PlaceSearchResponse $response)
    {
        $this->service = $service;
        $this->responses[] = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function current(): mixed
    {
        if ($this->valid()) {
            return $this->responses[$this->position];
        }

        return null;
    }

    /**s
     * {@inheritdoc}
     */
    public function next(): void
    {
        if (!$this->valid()) {
            return;
        }

        ++$this->position;

        if ($this->valid()) {
            return;
        }

        $response = end($this->responses);

        if (!$response->hasNextPageToken()) {
            return;
        }

        $request = new PageTokenPlaceSearchRequest($response);
        $this->responses[] = $this->service->process($request)->current();
    }

    /**
     * {@inheritdoc}
     */
    public function key(): mixed
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return $this->position < count($this->responses);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}
