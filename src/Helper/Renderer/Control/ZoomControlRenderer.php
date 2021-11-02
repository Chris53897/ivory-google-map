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

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use InvalidArgumentException;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\JsonBuilder\JsonBuilder;

class ZoomControlRenderer extends AbstractJsonRenderer implements ControlRendererInterface
{
    /** @var ControlPositionRenderer */
    private $controlPositionRenderer;

    /** @var ZoomControlStyleRenderer */
    private $zoomControlStyleRenderer;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        ControlPositionRenderer $controlPositionRenderer,
        ZoomControlStyleRenderer $zoomControlStyleRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setControlPositionRenderer($controlPositionRenderer);
        $this->setZoomControlStyleRenderer($zoomControlStyleRenderer);
    }

    public function getControlPositionRenderer(): ControlPositionRenderer
    {
        return $this->controlPositionRenderer;
    }

    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer): void
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    public function getZoomControlStyleRenderer(): ZoomControlStyleRenderer
    {
        return $this->zoomControlStyleRenderer;
    }

    public function setZoomControlStyleRenderer(ZoomControlStyleRenderer $zoomControlStyleRenderer): void
    {
        $this->zoomControlStyleRenderer = $zoomControlStyleRenderer;
    }

    public function render(object $control): string
    {
        if (!$control instanceof ZoomControl) {
            throw new InvalidArgumentException(sprintf('Expected a "%s", got "%s".', ZoomControl::class, is_object($control) ? get_class($control) : gettype($control)));
        }

        return $this->getJsonBuilder()
            ->setValue('[position]', $this->controlPositionRenderer->render($control->getPosition()), false)
            ->setValue('[style]', $this->zoomControlStyleRenderer->render($control->getStyle()), false)
            ->build();
    }
}
