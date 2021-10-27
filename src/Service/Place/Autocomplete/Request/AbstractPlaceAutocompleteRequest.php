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

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Request;

use Ivory\GoogleMap\Base\Coordinate;

abstract class AbstractPlaceAutocompleteRequest implements PlaceAutocompleteRequestInterface
{
    /** @var string */
    private $input;

    /** @var int|null */
    private $offset;

    /** @var Coordinate|null */
    private $location;

    /** @var float|null */
    private $radius;

    /** @var string|null */
    private $language;

    public function __construct(string $input)
    {
        $this->setInput($input);
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

    public function hasOffset(): bool
    {
        return null !== $this->offset;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
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
        $query = ['input' => $this->input];

        if ($this->hasOffset()) {
            $query['offset'] = $this->offset;
        }

        if ($this->hasLocation()) {
            $query['location'] = $this->buildCoordinate($this->location);
        }

        if ($this->hasRadius()) {
            $query['radius'] = $this->radius;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    private function buildCoordinate(Coordinate $coordinate): string
    {
        return $coordinate->getLatitude().','.$coordinate->getLongitude();
    }
}
