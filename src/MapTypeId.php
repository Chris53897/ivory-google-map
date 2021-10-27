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

namespace Ivory\GoogleMap;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
 */
final class MapTypeId
{
    public const HYBRID    = 'hybrid';
    public const ROADMAP   = 'roadmap';
    public const SATELLITE = 'satellite';
    public const TERRAIN   = 'terrain';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
