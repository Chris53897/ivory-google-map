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

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 */
class Circle implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /** @var Coordinate */
    private $center;

    /** @var float */
    private $radius;

    public function __construct(Coordinate $center, float $radius = 1.0, array $options = [])
    {
        $this->setCenter($center);
        $this->setRadius($radius);
        $this->addOptions($options);
    }

    public function getCenter(): Coordinate
    {
        return $this->center;
    }

    public function setCenter(Coordinate $center): void
    {
        $this->center = $center;
    }

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): void
    {
        $this->radius = $radius;
    }
}
