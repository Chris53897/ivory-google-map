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

namespace Ivory\GoogleMap\Service\Base\Location;

use Ivory\GoogleMap\Base\Coordinate;

class CoordinateLocation implements LocationInterface
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

    /** {@inheritdoc} */
    public function buildQuery(): string
    {
        return $this->coordinate->getLatitude().','.$this->coordinate->getLongitude();
    }
}
