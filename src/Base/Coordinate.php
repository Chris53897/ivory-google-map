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

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLng
 */
class Coordinate implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var bool */
    private $noWrap;

    public function __construct(float $latitude = 0.0, float $longitude = 0.0, bool $noWrap = true)
    {
        $this->latitude =$latitude;
        $this->longitude = $longitude;
        $this->noWrap = $noWrap;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function isNoWrap(): bool
    {
        return $this->noWrap;
    }

    public function setNoWrap(bool $noWrap): void
    {
        $this->noWrap = $noWrap;
    }
}
