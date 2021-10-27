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

namespace Ivory\GoogleMap\Service\Geocoder\Request;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 */
abstract class AbstractGeocoderRequest implements GeocoderRequestInterface
{
    /** @var string|null */
    private $language;

    public function hasLanguage(): bool
    {
        return null !== $this->language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language = null): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $query = [];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    protected function buildCoordinate(Coordinate $place): string
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
