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

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Overlay\InfoWindow;

abstract class AbstractInfoWindowRenderer extends AbstractJsonRenderer implements InfoWindowRendererInterface
{
    /** {@inheritdoc} */
    public function render(InfoWindow $infoWindow, bool $position = true): string
    {
        $formatter   = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        if ($position) {
            $jsonBuilder->setValue('[position]', $infoWindow->getPosition()->getVariable(), false);
        }

        if ($infoWindow->hasPixelOffset()) {
            $jsonBuilder->setValue('[pixelOffset]', $infoWindow->getPixelOffset()->getVariable(), false);
        }

        $jsonBuilder
            ->setValue('[content]', $infoWindow->getContent())
            ->setValues($infoWindow->getOptions());

        return $formatter->renderObjectAssignment($infoWindow, $formatter->renderObject($this->getClass(), [
            $jsonBuilder->build(),
        ], $this->getNamespace()));
    }

    abstract protected function getClass(): string;

    /** @return string|false|null */
    protected function getNamespace()
    {
    }
}
