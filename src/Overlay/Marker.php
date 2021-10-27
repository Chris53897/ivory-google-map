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
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 */
class Marker implements ExtendableInterface, OptionsAwareInterface, StaticOptionsAwareInterface
{
    use OptionsAwareTrait;
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    /** @var Coordinate */
    private $position;

    /** @var string|null */
    private $animation;

    /** @var Icon|null */
    private $icon;

    /** @var Symbol|null */
    private $symbol;

    /** @var MarkerShape|null */
    private $shape;

    /** @var InfoWindow|null */
    private $infoWindow;

    public function __construct(
        Coordinate  $position,
        string      $animation = null,
        Icon        $icon = null,
        Symbol      $symbol = null,
        MarkerShape $shape = null,
        array       $options = []
    ) {
        $this->setPosition($position);
        $this->setAnimation($animation);
        $this->setShape($shape);
        $this->addOptions($options);

        if (null !== $icon) {
            $this->setIcon($icon);
        } elseif (null !== $symbol) {
            $this->setSymbol($symbol);
        }
    }

    public function getPosition(): Coordinate
    {
        return $this->position;
    }

    public function setPosition(Coordinate $position): void
    {
        $this->position = $position;
    }

    public function hasAnimation(): bool
    {
        return null !== $this->animation;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    public function setAnimation(string $animation = null): void
    {
        $this->animation = $animation;
    }

    public function hasIcon(): bool
    {
        return null !== $this->icon;
    }

    public function getIcon(): ?Icon
    {
        return $this->icon;
    }

    public function setIcon(Icon $icon = null): void
    {
        $this->icon = $icon;

        if (null !== $icon) {
            $this->setSymbol(null);
        }
    }

    public function hasSymbol(): bool
    {
        return null !== $this->symbol;
    }

    public function getSymbol(): ?Symbol
    {
        return $this->symbol;
    }

    public function setSymbol(Symbol $symbol = null): void
    {
        $this->symbol = $symbol;

        if (null !== $symbol) {
            $this->setIcon(null);
        }
    }

    public function hasShape(): bool
    {
        return null !== $this->shape;
    }

    public function getShape(): ?MarkerShape
    {
        return $this->shape;
    }

    public function setShape(MarkerShape $shape = null): void
    {
        $this->shape = $shape;
    }

    public function hasInfoWindow(): bool
    {
        return null !== $this->infoWindow;
    }

    public function getInfoWindow(): ?InfoWindow
    {
        return $this->infoWindow;
    }

    public function setInfoWindow(InfoWindow $infoWindow = null): void
    {
        $this->infoWindow = $infoWindow;
    }
}
