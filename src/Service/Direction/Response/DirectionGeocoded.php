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

class DirectionGeocoded
{
    /** @var string|null */
    private $status;

    /** @var bool|null */
    private $partialMatch;

    /** @var string|null */
    private $placeId;

    /** @var string[] */
    private $types = [];

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

    public function hasPartialMatch(): bool
    {
        return null !== $this->partialMatch;
    }

    public function isPartialMatch(): ?bool
    {
        return $this->partialMatch;
    }

    public function setPartialMatch(?bool $partialMatch): void
    {
        $this->partialMatch = $partialMatch;
    }

    public function hasPlaceId(): bool
    {
        return null !== $this->placeId;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    public function setPlaceId(?string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /** @return string[] */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param string[] $types */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /** @param string[] $types */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function addType(string $type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    public function removeType(string $type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }
}
