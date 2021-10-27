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

namespace Ivory\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Base\Coordinate;

class ElevationResult
{
    /** @var Coordinate|null */
    private $location;

    /** @var float|null */
    private $elevation;

    /** @var float|null */
    private $resolution;

    public function hasLocation(): bool
    {
        return null !== $this->location;
    }

    public function getLocation(): ?Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location = null): void
    {
        $this->location = $location;
    }

    public function hasElevation(): bool
    {
        return null !== $this->elevation;
    }

    public function getElevation(): ?float
    {
        return $this->elevation;
    }

    public function setElevation(?float $elevation): void
    {
        $this->elevation = $elevation;
    }

    public function hasResolution(): bool
    {
        return null !== $this->resolution;
    }

    public function getResolution(): ?float
    {
        return $this->resolution;
    }

    public function setResolution(?float $resolution): void
    {
        $this->resolution = $resolution;
    }
}
