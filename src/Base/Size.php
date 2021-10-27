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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Size
 */
class Size implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    /** @var string */
    private $widthUnit;

    /** @var string */
    private $heightUnit;

    public function __construct(float $width = 1.0, float $height = 1.0, ?string $widthUnit = null, ?string $heightUnit = null)
    {
        $this->width      = $width;
        $this->height     = $height;
        $this->widthUnit  = $widthUnit;
        $this->heightUnit = $heightUnit;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function hasUnits(): bool
    {
        return $this->hasWidthUnit() && $this->hasHeightUnit();
    }

    public function hasWidthUnit(): bool
    {
        return null !== $this->widthUnit;
    }

    public function getWidthUnit(): ?string
    {
        return $this->widthUnit;
    }

    public function setWidthUnit(?string $widthUnit = null): void
    {
        $this->widthUnit = $widthUnit;
    }

    public function hasHeightUnit(): bool
    {
        return null !== $this->heightUnit;
    }

    public function getHeightUnit(): ?string
    {
        return $this->heightUnit;
    }

    public function setHeightUnit(?string $heightUnit = null): void
    {
        $this->heightUnit = $heightUnit;
    }
}
