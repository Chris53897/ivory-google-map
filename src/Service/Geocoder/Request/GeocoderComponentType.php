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

namespace Ivory\GoogleMap\Service\Geocoder\Request;

final class GeocoderComponentType
{
    public const ROUTE               = 'route';
    public const LOCALITY            = 'locality';
    public const ADMINISTRATIVE_AREA = 'administrative_area';
    public const POSTAL_CODE         = 'postal_code';
    public const COUNTRY             = 'country';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
