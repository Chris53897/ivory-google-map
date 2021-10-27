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

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#UnitSystem
 */
final class UnitSystem
{
    public const IMPERIAL = 'IMPERIAL';
    public const METRIC   = 'METRIC';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
