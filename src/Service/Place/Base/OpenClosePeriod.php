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

namespace Ivory\GoogleMap\Service\Place\Base;

class OpenClosePeriod
{
    /** @var int|null */
    private $day;

    /** @var string|null */
    private $time;

    public function hasDay(): bool
    {
        return null !== $this->day;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): void
    {
        $this->day = $day;
    }

    public function hasTime(): bool
    {
        return null !== $this->time;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }
}
