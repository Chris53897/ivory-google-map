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

use Ivory\GoogleMap\Overlay\Marker;

class MarkerRenderer
{
    /** @var MarkerStyleRenderer */
    private $markerStyleRenderer;

    /** @var MarkerLocationRenderer */
    private $markerLocationRenderer;

    public function __construct(
        MarkerStyleRenderer $markerStyleRenderer,
        MarkerLocationRenderer $markerLocationRenderer
    ) {
        $this->markerStyleRenderer = $markerStyleRenderer;
        $this->markerLocationRenderer = $markerLocationRenderer;
    }

    public function render(array $markers): string
    {
        $result = [];
        $marker = current($markers);
        $style = $this->markerStyleRenderer->render($marker);

        if (!empty($style)) {
            $result[] = $style;
        }

        foreach ($markers as $marker) {
            $result[] = $this->markerLocationRenderer->render($marker);
        }

        return implode('|', $result);
    }
}
