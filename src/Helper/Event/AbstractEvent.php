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

namespace Ivory\GoogleMap\Helper\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AbstractEvent extends Event
{
    /** @var string */
    private $code = '';

    public function hasCode(): bool
    {
        return !empty($this->code);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function addCode(string $code): void
    {
        $this->code .= $code;
    }
}
