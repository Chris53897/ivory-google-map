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

class CustomControl
{
    /** @var string */
    private $position;

    /** @var string */
    private $control;

    public function __construct(string $position, string $control)
    {
        $this->setPosition($position);
        $this->setControl($control);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getControl(): string
    {
        return $this->control;
    }

    public function setControl(string $control): void
    {
        $this->control = $control;
    }
}
