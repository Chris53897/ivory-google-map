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

use Ivory\GoogleMap\Base\Coordinate;

class NearbyPlaceSearchRequest extends AbstractTextualPlaceSearchRequest
{
    /** @var string */
    private $rankBy;

    public function __construct(Coordinate $location, string $rankBy, float $radius = null)
    {
        $this->setLocation($location);
        $this->setRankBy($rankBy);
        $this->setRadius($radius);
    }

    public function getRankBy(): string
    {
        return $this->rankBy;
    }

    public function setRankBy(string $rankBy): void
    {
        $this->rankBy = $rankBy;
    }

    public function buildContext(): string
    {
        return 'nearbysearch';
    }

    public function buildQuery(): array
    {
        $query = parent::buildQuery();
        $query['rankby'] = $this->rankBy;

        return $query;
    }
}
