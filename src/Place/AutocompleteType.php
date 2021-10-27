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

namespace Ivory\GoogleMap\Place;

final class AutocompleteType
{
    public const ESTABLISHMENT = 'establishment';
    public const GEOCODE = 'geocode';
    public const REGIONS = '(regions)';
    public const CITIES = '(cities)';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
