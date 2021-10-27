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

class StyleRenderer
{
    public function render(array $style): string
    {
        $result = [];

        if (isset($style['feature'])) {
            $result[] = $this->renderStyle('feature', $style['feature']);
        }

        if (isset($style['element'])) {
            $result[] = $this->renderStyle('element', $style['element']);
        }

        foreach ($style['rules'] as $rule => $value) {
            $result[] = $this->renderStyle($rule, $value);
        }

        return implode('|', $result);
    }

    private function renderStyle(string $name, string $value): string
    {
        return $name.':'.$value;
    }
}
