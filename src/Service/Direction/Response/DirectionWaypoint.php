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

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;

class DirectionWaypoint
{
    /** @var Coordinate|null */
    private $location;

    /** @var int|null */
    private $stepIndex;

    /** @var float|null */
    private $stepInterpolation;

    public function hasLocation(): bool
    {
        return null !== $this->location;
    }

    public function getLocation(): ?Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function hasStepIndex(): bool
    {
        return null !== $this->stepIndex;
    }

    public function getStepIndex(): ?int
    {
        return $this->stepIndex;
    }

    public function setStepIndex(?int $stepIndex): void
    {
        $this->stepIndex = $stepIndex;
    }

    public function hasStepInterpolation(): bool
    {
        return null !== $this->stepInterpolation;
    }

    public function getStepInterpolation(): ?float
    {
        return $this->stepInterpolation;
    }

    public function setStepInterpolation(?float $stepInterpolation): void
    {
        $this->stepInterpolation = $stepInterpolation;
    }
}
