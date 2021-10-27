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

namespace Ivory\GoogleMap\Control;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlOptions
 */
class ScaleControl
{
    /** @var string */
    private $position;

    /** @var string */
    private $style;

    public function __construct(string $position = ControlPosition::BOTTOM_LEFT, string $style = ScaleControlStyle::DEFAULT_)
    {
        $this->setPosition($position);
        $this->setStyle($style);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function setStyle(string $style): void
    {
        $this->style = $style;
    }
}
