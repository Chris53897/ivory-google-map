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

namespace Ivory\GoogleMap\Service\Direction\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionWaypoint
 */
class DirectionWaypoint
{
    /** @var LocationInterface */
    private $location;

    /** @var bool|null */
    private $stopover;

    public function __construct(LocationInterface $location, ?bool $stopover = null)
    {
        $this->setLocation($location);
        $this->setStopover($stopover);
    }

    public function getLocation(): LocationInterface
    {
        return $this->location;
    }

    public function setLocation(LocationInterface $location): void
    {
        $this->location = $location;
    }

    public function hasStopover(): bool
    {
        return null !== $this->stopover;
    }

    public function getStopover(): ?bool
    {
        return $this->stopover;
    }

    public function setStopover(?bool $stopover = null): void
    {
        $this->stopover = $stopover;
    }
}
