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

namespace Ivory\GoogleMap\Service\Place\Detail\Request;

class PlaceDetailRequest implements PlaceDetailRequestInterface
{
    /** @var string */
    private $placeId;

    /** @var string|null */
    private $language;

    public function __construct(string $placeId)
    {
        $this->setPlaceId($placeId);
    }

    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    public function setPlaceId(string $placeId): void
    {
        $this->placeId = $placeId;
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
        $query = ['placeid' => $this->placeId];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }
}
