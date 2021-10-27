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

namespace Ivory\GoogleMap\Service\Base;

final class Avoid
{
    public const TOLLS    = 'tolls';
    public const HIGHWAYS = 'highways';
    public const FERRIES  = 'ferries';
    public const INDOOR   = 'indoor';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
