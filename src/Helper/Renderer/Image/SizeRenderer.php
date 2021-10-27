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

namespace Ivory\GoogleMap\Helper\Renderer\Image;

use Ivory\GoogleMap\Map;

class SizeRenderer
{
    public function render(Map $map): string
    {
        return $this->getDimension($map, 'width').'x'.$this->getDimension($map, 'height');
    }

    private function getDimension(Map $map, string $side): string
    {
        return $map->hasStaticOption($side) ? $map->getStaticOption($side) : '300';
    }
}
