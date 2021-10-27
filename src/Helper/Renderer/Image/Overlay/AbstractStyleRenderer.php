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

namespace Ivory\GoogleMap\Helper\Renderer\Image\Overlay;

abstract class AbstractStyleRenderer
{
    public function renderStyle(array $styles): string
    {
        if (empty($styles)) {
            return '';
        }

        $result = [];
        ksort($styles);

        foreach ($styles as $style => $value) {
            $result[] = $style.':'.$value;
        }

        return implode('|', $result);
    }
}
