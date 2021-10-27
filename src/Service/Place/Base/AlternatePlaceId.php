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

namespace Ivory\GoogleMap\Service\Place\Base;

class AlternatePlaceId
{
    /** @var string|null */
    private $placeId;

    /** @var string|null */
    private $scope;

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

    public function hasScope(): bool
    {
        return null !== $this->scope;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(?string $scope): void
    {
        $this->scope = $scope;
    }
}
