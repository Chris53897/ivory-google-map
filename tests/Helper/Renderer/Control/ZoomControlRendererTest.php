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

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlStyleRenderer;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

class ZoomControlRendererTest extends TestCase
{
    /** @var ZoomControlRenderer */
    private $zoomControlRenderer;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->zoomControlRenderer = new ZoomControlRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new ControlPositionRenderer($formatter),
            new ZoomControlStyleRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->zoomControlRenderer);
        $this->assertInstanceOf(ControlRendererInterface::class, $this->zoomControlRenderer);
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->zoomControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->zoomControlRenderer->getControlPositionRenderer());
    }

    public function testZoomControlStyleRenderer()
    {
        $zoomControlStyleRenderer = $this->createZoomControlStyleRendererMock();
        $this->zoomControlRenderer->setZoomControlStyleRenderer($zoomControlStyleRenderer);

        $this->assertSame($zoomControlStyleRenderer, $this->zoomControlRenderer->getZoomControlStyleRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '{"position":google.maps.ControlPosition.TOP_LEFT,"style":google.maps.ZoomControlStyle.DEFAULT}',
            $this->zoomControlRenderer->render(new ZoomControl())
        );
    }

    public function testRenderWithInvalidControl()
    {
        $this->expectException(\TypeError::class);

        $this->zoomControlRenderer->render('foo');
    }

    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }

    private function createZoomControlStyleRendererMock()
    {
        return $this->createMock(ZoomControlStyleRenderer::class);
    }
}
