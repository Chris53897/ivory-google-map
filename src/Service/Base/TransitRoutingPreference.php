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

final class TransitRoutingPreference
{
    public const LESS_WALKING    = 'less_walking';
    public const FEWER_TRANSFERS = 'fewer_transfers';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
