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
class GeocoderCoordinateRequest extends AbstractGeocoderReverseRequest
{
    /** @var Coordinate */
    private $coordinate;

    public function __construct(Coordinate $coordinate)
    {
        $this->setCoordinate($coordinate);
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function setCoordinate(Coordinate $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    public function buildQuery(): array
    {
        return array_merge(['latlng' => $this->buildCoordinate($this->coordinate)], parent::buildQuery());
    }
}
