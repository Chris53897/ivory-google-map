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

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Base\Coordinate;

class DirectionTransitStop
{
    /** @var string|null */
    private $name;

    /** @var Coordinate|null */
    private $location;

    public function hasName(): bool
    {
        return null !== $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

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
}
