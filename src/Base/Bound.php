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

namespace Ivory\GoogleMap\Base;

use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 */
class Bound implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var Coordinate|null */
    private $southWest;

    /** @var Coordinate|null */
    private $northEast;

    /** @var ExtendableInterface[] */
    private $extendables = [];

    public function __construct(Coordinate $southWest = null, Coordinate $northEast = null)
    {
        $this->southWest = $southWest;
        $this->northEast = $northEast;
    }

    public function hasCoordinates(): bool
    {
        return $this->hasSouthWest() && $this->hasNorthEast();
    }

    public function hasSouthWest(): bool
    {
        return null !== $this->southWest;
    }

    public function getSouthWest(): ?Coordinate
    {
        return $this->southWest;
    }

    public function setSouthWest(Coordinate $southWest = null): void
    {
        $this->southWest = $southWest;
    }

    public function hasNorthEast(): bool
    {
        return null !== $this->northEast;
    }

    public function getNorthEast(): ?Coordinate
    {
        return $this->northEast;
    }

    public function setNorthEast(Coordinate $northEast = null): void
    {
        $this->northEast = $northEast;
    }

    public function hasExtendables(): bool
    {
        return !empty($this->extendables);
    }

    /** @return ExtendableInterface[] */
    public function getExtendables(): array
    {
        return $this->extendables;
    }

    /** @param ExtendableInterface[] $extendables */
    public function setExtendables(array $extendables): void
    {
        $this->extendables = [];
        $this->addExtendables($extendables);
    }

    /** @param ExtendableInterface[] $extendables */
    public function addExtendables(array $extendables): void
    {
        foreach ($extendables as $extendable) {
            $this->addExtendable($extendable);
        }
    }

    public function hasExtendable(ExtendableInterface $extendable): bool
    {
        return in_array($extendable, $this->extendables, true);
    }

    public function addExtendable(ExtendableInterface $extendable): void
    {
        if (!$this->hasExtendable($extendable)) {
            $this->extendables[] = $extendable;
        }
    }

    public function removeExtendable(ExtendableInterface $extendable): void
    {
        unset($this->extendables[array_search($extendable, $this->extendables, true)]);
        $this->extendables = empty($this->extendables) ? [] : array_values($this->extendables);
    }
}
