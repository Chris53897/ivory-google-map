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

namespace Ivory\GoogleMap\Service\Geocoder\Response;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderStatus
 */
final class GeocoderStatus
{
    public const ERROR = 'ERROR';
    public const INVALID_REQUEST = 'INVALID_REQUEST';
    public const OK = 'OK';
    public const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    public const REQUEST_DENIED = 'REQUEST_DENIED';
    public const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    public const ZERO_RESULTS = 'ZERO_RESULTS';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
