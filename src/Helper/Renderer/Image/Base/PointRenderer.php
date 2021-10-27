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

namespace Ivory\GoogleMap\Helper\Renderer\Image\Base;

use Ivory\GoogleMap\Base\Point;

class PointRenderer
{
    public function render(Point $point): string
    {
        return $point->getX().','.$point->getY();
    }
}
