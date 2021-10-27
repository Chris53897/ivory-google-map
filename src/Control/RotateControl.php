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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#RotateControlOptions
 */
class RotateControl
{
    /** @var string */
    private $position;

    public function __construct(string $position = ControlPosition::TOP_LEFT)
    {
        $this->setPosition($position);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition($position): void
    {
        $this->position = $position;
    }
}
