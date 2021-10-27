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

namespace Ivory\GoogleMap;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 */
class Map implements VariableAwareInterface, StaticOptionsAwareInterface
{
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    /** @var string */
    private $htmlId = 'map_canvas';

    /** @var bool */
    private $autoZoom = false;

    /** @var Coordinate */
    private $center;

    /** @var Bound */
    private $bound;

    /** @var ControlManager */
    private $controlManager;

    /** @var EventManager */
    private $eventManager;

    /** @var LayerManager */
    private $layerManager;

    /** @var OverlayManager */
    private $overlayManager;

    /** @var string[] */
    private $libraries = [];

    /** @var array */
    private $mapOptions = [];

    /** @var string[] */
    private $stylesheetOptions = [];

    /** @var string[] */
    private $htmlAttributes = [];

    public function __construct()
    {
        $this->setCenter(new Coordinate());
        $this->setBound(new Bound());
        $this->setControlManager(new ControlManager());
        $this->setEventManager(new EventManager());
        $this->setOverlayManager(new OverlayManager());
        $this->setLayerManager(new LayerManager());
    }

    public function getHtmlId(): string
    {
        return $this->htmlId;
    }

    public function setHtmlId(string $htmlId): void
    {
        $this->htmlId = $htmlId;
    }

    public function isAutoZoom(): bool
    {
        return $this->autoZoom;
    }

    public function setAutoZoom(bool $autoZoom): void
    {
        $this->autoZoom = $autoZoom;
    }

    public function getCenter(): Coordinate
    {
        return $this->center;
    }

    public function setCenter(Coordinate $center): void
    {
        $this->center = $center;
    }

    public function getBound(): Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound): void
    {
        $this->bound = $bound;
    }

    public function getControlManager(): ControlManager
    {
        return $this->controlManager;
    }

    public function setControlManager(ControlManager $controlManager): void
    {
        $this->controlManager = $controlManager;
    }

    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function getLayerManager(): ?LayerManager
    {
        return $this->layerManager;
    }

    public function setLayerManager(LayerManager $layerManager): void
    {
        $this->layerManager = $layerManager;

        if ($layerManager->getMap() !== $this) {
            $layerManager->setMap($this);
        }
    }

    public function getOverlayManager(): ?OverlayManager
    {
        return $this->overlayManager;
    }

    public function setOverlayManager(OverlayManager $overlayManager): void
    {
        $this->overlayManager = $overlayManager;

        if ($overlayManager->getMap() !== $this) {
            $overlayManager->setMap($this);
        }
    }

    public function hasLibraries(): bool
    {
        return !empty($this->libraries);
    }

    /** @return string[] */
    public function getLibraries(): array
    {
        return $this->libraries;
    }

    /** @param string[] $libraries */
    public function setLibraries(array $libraries): void
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /** @param string[] $libraries */
    public function addLibraries(array $libraries): void
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    public function hasLibrary(string $library): bool
    {
        return in_array($library, $this->libraries, true);
    }

    public function addLibrary(string $library): void
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    public function removeLibrary(string $library): void
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
        $this->libraries = empty($this->libraries) ? [] : array_values($this->libraries);
    }

    public function hasMapOptions(): bool
    {
        return !empty($this->mapOptions);
    }

    public function getMapOptions(): array
    {
        return $this->mapOptions;
    }

    public function setMapOptions(array $mapOptions): void
    {
        $this->mapOptions = [];
        $this->addMapOptions($mapOptions);
    }

    public function addMapOptions(array $mapOptions): void
    {
        foreach ($mapOptions as $mapOption => $value) {
            $this->setMapOption($mapOption, $value);
        }
    }

    public function hasMapOption(string $mapOption): bool
    {
        return isset($this->mapOptions[$mapOption]);
    }

    public function getMapOption(string $mapOption)
    {
        return $this->hasMapOption($mapOption) ? $this->mapOptions[$mapOption] : null;
    }

    public function setMapOption(string $mapOption, $value): void
    {
        $this->mapOptions[$mapOption] = $value;
    }

    public function removeMapOption(string $mapOption): void
    {
        unset($this->mapOptions[$mapOption]);
    }

    public function hasStylesheetOptions(): bool
    {
        return !empty($this->stylesheetOptions);
    }

    /** @return string[] */
    public function getStylesheetOptions(): array
    {
        return $this->stylesheetOptions;
    }

    /** @param string[] $stylesheetOptions */
    public function setStylesheetOptions(array $stylesheetOptions): void
    {
        $this->stylesheetOptions = [];
        $this->addStylesheetOptions($stylesheetOptions);
    }

    /** @param string[] $stylesheetOptions */
    public function addStylesheetOptions(array $stylesheetOptions): void
    {
        foreach ($stylesheetOptions as $stylesheetOption => $value) {
            $this->setStylesheetOption($stylesheetOption, $value);
        }
    }

    public function hasStylesheetOption(string $stylesheetOption): bool
    {
        return isset($this->stylesheetOptions[$stylesheetOption]);
    }

    public function getStylesheetOption(string $stylesheetOption): ?string
    {
        return $this->hasStylesheetOption($stylesheetOption) ? $this->stylesheetOptions[$stylesheetOption] : null;
    }

    public function setStylesheetOption(string $stylesheetOption, ?string $value): void
    {
        $this->stylesheetOptions[$stylesheetOption] = $value;
    }

    public function removeStylesheetOption(string $stylesheetOption): void
    {
        unset($this->stylesheetOptions[$stylesheetOption]);
    }

    public function hasHtmlAttributes(): bool
    {
        return !empty($this->htmlAttributes);
    }

    /** @return string[] */
    public function getHtmlAttributes(): array
    {
        return $this->htmlAttributes;
    }

    /** @param string[] $htmlAttributes */
    public function setHtmlAttributes(array $htmlAttributes): void
    {
        $this->htmlAttributes = [];
        $this->addHtmlAttributes($htmlAttributes);
    }

    /** @param string[] $htmlAttributes */
    public function addHtmlAttributes(array $htmlAttributes): void
    {
        foreach ($htmlAttributes as $htmlAttribute => $value) {
            $this->setHtmlAttribute($htmlAttribute, $value);
        }
    }

    public function hasHtmlAttribute(string $htmlAttribute): bool
    {
        return isset($this->htmlAttributes[$htmlAttribute]);
    }

    public function getHtmlAttribute(string $htmlAttribute): ?string
    {
        return $this->hasHtmlAttribute($htmlAttribute) ? $this->htmlAttributes[$htmlAttribute] : null;
    }

    public function setHtmlAttribute(string $htmlAttribute, ?string $value): void
    {
        $this->htmlAttributes[$htmlAttribute] = $value;
    }

    public function removeHtmlAttribute(string $htmlAttribute): void
    {
        unset($this->htmlAttributes[$htmlAttribute]);
    }
}
