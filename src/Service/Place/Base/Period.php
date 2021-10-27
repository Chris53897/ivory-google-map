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

class Period
{
    /** @var OpenClosePeriod|null */
    private $open;

    /** @var OpenClosePeriod|null */
    private $close;

    public function hasOpen(): bool
    {
        return null !== $this->open;
    }

    public function getOpen(): ?OpenClosePeriod
    {
        return $this->open;
    }

    public function setOpen(OpenClosePeriod $open = null): void
    {
        $this->open = $open;
    }

    public function hasClose(): bool
    {
        return null !== $this->close;
    }

    public function getClose(): ?OpenClosePeriod
    {
        return $this->close;
    }

    public function setClose(OpenClosePeriod $close = null): void
    {
        $this->close = $close;
    }
}
