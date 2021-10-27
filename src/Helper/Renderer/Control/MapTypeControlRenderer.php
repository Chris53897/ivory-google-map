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
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\JsonBuilder\JsonBuilder;

class MapTypeControlRenderer extends AbstractJsonRenderer implements ControlRendererInterface
{
    /** @var MapTypeIdRenderer */
    private $mapTypeIdRenderer;

    /** @var ControlPositionRenderer */
    private $controlPositionRenderer;

    /** @var MapTypeControlStyleRenderer */
    private $mapTypeControlStyleRenderer;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        MapTypeIdRenderer $mapTypeIdRenderer,
        ControlPositionRenderer $controlPositionRenderer,
        MapTypeControlStyleRenderer $mapTypeControlStyleRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer);
        $this->setControlPositionRenderer($controlPositionRenderer);
        $this->setMapTypeControlStyleRenderer($mapTypeControlStyleRenderer);
    }

    public function getMapTypeIdRenderer(): MapTypeIdRenderer
    {
        return $this->mapTypeIdRenderer;
    }

    public function setMapTypeIdRenderer(MapTypeIdRenderer $mapTypeIdRenderer): void
    {
        $this->mapTypeIdRenderer = $mapTypeIdRenderer;
    }

    public function getControlPositionRenderer(): ControlPositionRenderer
    {
        return $this->controlPositionRenderer;
    }

    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer): void
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    public function getMapTypeControlStyleRenderer(): MapTypeControlStyleRenderer
    {
        return $this->mapTypeControlStyleRenderer;
    }

    public function setMapTypeControlStyleRenderer(MapTypeControlStyleRenderer $mapTypeControlStyleRenderer): void
    {
        $this->mapTypeControlStyleRenderer = $mapTypeControlStyleRenderer;
    }

    public function render(object $control): string
    {
        if (!$control instanceof MapTypeControl) {
            throw new InvalidArgumentException(sprintf('Expected a "%s", got "%s".', MapTypeControl::class, is_object($control) ? get_class($control) : gettype($control)));
        }

        $jsonBuilder = $this->getJsonBuilder();

        foreach ($control->getIds() as $index => $id) {
            $jsonBuilder->setValue('[mapTypeIds]['.$index.']', $this->mapTypeIdRenderer->render($id), false);
        }

        return $jsonBuilder
            ->setValue('[position]', $this->controlPositionRenderer->render($control->getPosition()), false)
            ->setValue('[style]', $this->mapTypeControlStyleRenderer->render($control->getStyle()), false)
            ->build();
    }
}
