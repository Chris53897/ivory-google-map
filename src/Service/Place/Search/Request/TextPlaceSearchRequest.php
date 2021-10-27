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

class TextPlaceSearchRequest extends AbstractPlaceSearchRequest
{
    /** @var string */
    private $query;

    public function __construct(string $query)
    {
        $this->setQuery($query);
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function buildContext(): string
    {
        return 'textsearch';
    }

    public function buildQuery(): array
    {
        $query = parent::buildQuery();
        $query['query'] = $this->query;

        return $query;
    }
}
