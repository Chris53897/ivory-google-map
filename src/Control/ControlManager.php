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

namespace Ivory\GoogleMap\Control;

class ControlManager
{
    /** @var FullscreenControl|null */
    private $fullscreenControl;

    /** @var MapTypeControl|null */
    private $mapTypeControl;

    /** @var RotateControl|null */
    private $rotateControl;

    /** @var ScaleControl|null */
    private $scaleControl;

    /** @var StreetViewControl|null */
    private $streetViewControl;

    /** @var ZoomControl|null */
    private $zoomControl;

    /** @var CustomControl[] */
    private $customControls = [];

    public function hasFullscreenControl(): bool
    {
        return null !== $this->fullscreenControl;
    }

    public function getFullscreenControl(): ?FullscreenControl
    {
        return $this->fullscreenControl;
    }

    public function setFullscreenControl(FullscreenControl $fullscreenControl = null): void
    {
        $this->fullscreenControl = $fullscreenControl;
    }

    public function hasMapTypeControl(): bool
    {
        return null !== $this->mapTypeControl;
    }

    public function getMapTypeControl(): ?MapTypeControl
    {
        return $this->mapTypeControl;
    }

    public function setMapTypeControl(MapTypeControl $mapTypeControl = null): void
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    public function hasRotateControl(): bool
    {
        return null !== $this->rotateControl;
    }

    public function getRotateControl(): ?RotateControl
    {
        return $this->rotateControl;
    }

    public function setRotateControl(RotateControl $rotateControl = null): void
    {
        $this->rotateControl = $rotateControl;
    }

    public function hasScaleControl(): bool
    {
        return null !== $this->scaleControl;
    }

    public function getScaleControl(): ?ScaleControl
    {
        return $this->scaleControl;
    }

    public function setScaleControl(ScaleControl $scaleControl = null): void
    {
        $this->scaleControl = $scaleControl;
    }

    public function hasStreetViewControl(): bool
    {
        return null !== $this->streetViewControl;
    }

    public function getStreetViewControl(): ?StreetViewControl
    {
        return $this->streetViewControl;
    }

    public function setStreetViewControl(StreetViewControl $streetViewControl = null): void
    {
        $this->streetViewControl = $streetViewControl;
    }

    public function hasZoomControl(): bool
    {
        return null !== $this->zoomControl;
    }

    public function getZoomControl(): ?ZoomControl
    {
        return $this->zoomControl;
    }

    public function setZoomControl(ZoomControl $zoomControl = null): void
    {
        $this->zoomControl = $zoomControl;
    }

    public function hasCustomControls(): bool
    {
        return !empty($this->customControls);
    }

    /** @return CustomControl[] */
    public function getCustomControls(): array
    {
        return $this->customControls;
    }

    /** @param CustomControl[] $customControls */
    public function setCustomControls(array $customControls): void
    {
        $this->customControls = [];
        $this->addCustomControls($customControls);
    }

    /** @param CustomControl[] $customControls */
    public function addCustomControls(array $customControls): void
    {
        foreach ($customControls as $customControl) {
            $this->addCustomControl($customControl);
        }
    }

    public function hasCustomControl(CustomControl $customControl): bool
    {
        return in_array($customControl, $this->customControls, true);
    }

    public function addCustomControl(CustomControl $customControl): void
    {
        if (!$this->hasCustomControl($customControl)) {
            $this->customControls[] = $customControl;
        }
    }

    public function removeCustomControl(CustomControl $customControl): void
    {
        unset($this->customControls[array_search($customControl, $this->customControls, true)]);
        $this->customControls = empty($this->customControls) ? [] : array_values($this->customControls);
    }
}
