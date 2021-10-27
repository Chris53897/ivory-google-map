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

namespace Ivory\GoogleMap\Service\Base\Location;

class PlaceIdLocation implements LocationInterface
{
    /** @var string */
    private $placeId;

    public function __construct(string $placeId)
    {
        $this->setPlaceId($placeId);
    }

    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    public function setPlaceId(string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function buildQuery(): string
    {
        return 'place_id:'.$this->placeId;
    }
}
