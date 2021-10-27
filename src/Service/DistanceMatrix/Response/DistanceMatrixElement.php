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

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;

class DistanceMatrixElement
{
    /** @var string|null */
    private $status;

    /** @var Distance|null */
    private $distance;

    /** @var Duration|null */
    private $duration;

    /** @var Duration|null */
    private $durationInTraffic;

    /** @var Fare|null */
    private $fare;

    public function hasStatus(): bool
    {
        return null !== $this->status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function hasDistance(): bool
    {
        return null !== $this->distance;
    }

    public function getDistance(): ?Distance
    {
        return $this->distance;
    }

    public function setDistance(Distance $distance = null): void
    {
        $this->distance = $distance;
    }

    public function hasDuration(): bool
    {
        return null !== $this->duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setDuration(Duration $duration = null): void
    {
        $this->duration = $duration;
    }

    public function hasDurationInTraffic(): bool
    {
        return null !== $this->durationInTraffic;
    }

    public function getDurationInTraffic(): ?Duration
    {
        return $this->durationInTraffic;
    }

    public function setDurationInTraffic(Duration $durationInTraffic = null): void
    {
        $this->durationInTraffic = $durationInTraffic;
    }

    public function hasFare(): bool
    {
        return null !== $this->fare;
    }

    public function getFare(): ?Fare
    {
        return $this->fare;
    }

    public function setFare(Fare $fare = null): void
    {
        $this->fare = $fare;
    }
}
