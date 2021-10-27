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

abstract class AbstractPlaceSearchRequest implements PlaceSearchRequestInterface
{
    /** @var Coordinate|null */
    private $location;

    /** @var float|null */
    private $radius;

    /** @var int|null */
    private $minPrice;

    /** @var int|null */
    private $maxPrice;

    /** @var bool|null */
    private $openNow;

    /** @var string|null */
    private $type;

    /** @var string|null */
    private $language;

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

    public function hasRadius(): bool
    {
        return null !== $this->radius;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(?float $radius): void
    {
        $this->radius = $radius;
    }

    public function hasMinPrice(): bool
    {
        return null !== $this->minPrice;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    public function hasMaxPrice(): bool
    {
        return null !== $this->maxPrice;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    public function hasOpenNow(): bool
    {
        return null !== $this->openNow;
    }

    public function isOpenNow(): ?bool
    {
        return $this->openNow;
    }

    public function setOpenNow(?bool $openNow): void
    {
        $this->openNow = $openNow;
    }

    public function hasType(): bool
    {
        return null !== $this->type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function hasLanguage(): bool
    {
        return null !== $this->language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $query = [];

        if ($this->hasLocation()) {
            $query['location'] = $this->buildCoordinate($this->location);
        }

        if ($this->hasRadius()) {
            $query['radius'] = $this->radius;
        }

        if ($this->hasMinPrice()) {
            $query['minprice'] = $this->minPrice;
        }

        if ($this->hasMaxPrice()) {
            $query['maxprice'] = $this->maxPrice;
        }

        if ($this->hasOpenNow()) {
            $query['opennow'] = $this->openNow;
        }

        if ($this->hasType()) {
            $query['type'] = $this->type;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    private function buildCoordinate(Coordinate $place): string
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
