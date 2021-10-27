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

namespace Ivory\GoogleMap\Service\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

class Geometry
{
    /** @var Coordinate|null */
    private $location;

    /** @var string|null */
    private $locationType;

    /** @var Bound|null */
    private $viewport;

    /** @var Bound|null */
    private $bound;

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

    public function hasLocationType(): bool
    {
        return null !== $this->locationType;
    }

    public function getLocationType(): ?string
    {
        return $this->locationType;
    }

    public function setLocationType(?string $locationType = null): void
    {
        $this->locationType = $locationType;
    }

    public function hasViewport(): bool
    {
        return null !== $this->viewport;
    }

    public function getViewport(): ?Bound
    {
        return $this->viewport;
    }

    public function setViewport(Bound $viewport = null): void
    {
        $this->viewport = $viewport;
    }

    public function hasBound(): bool
    {
        return null !== $this->bound;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }
}
