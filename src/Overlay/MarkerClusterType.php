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

namespace Ivory\GoogleMap\Overlay;

final class MarkerClusterType
{
    public const DEFAULT_         = 'default';
    public const MARKER_CLUSTERER = 'marker_clusterer';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
