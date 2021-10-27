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

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Animation
 */
final class Animation
{
    public const BOUNCE = 'bounce';
    public const DROP   = 'drop';

    /** @codeCoverageIgnore */
    private function __construct()
    {
    }
}
