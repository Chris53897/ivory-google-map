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

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;

abstract class AbstractRenderer
{
    /** @var Formatter */
    private $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->setFormatter($formatter);
    }

    public function getFormatter(): Formatter
    {
        return $this->formatter;
    }

    public function setFormatter(Formatter $formatter): void
    {
        $this->formatter = $formatter;
    }
}
