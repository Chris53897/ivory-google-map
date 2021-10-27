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

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;

class InfoWindowCollector extends AbstractCollector
{
    public const STRATEGY_MAP    = 1;
    public const STRATEGY_MARKER = 2;

    /** @var MarkerCollector */
    private $markerCollector;

    /** @var string|null */
    private $type;

    public function __construct(MarkerCollector $markerCollector, ?string $type = null)
    {
        $this->setMarkerCollector($markerCollector);
        $this->setType($type);
    }

    public function getMarkerCollector(): MarkerCollector
    {
        return $this->markerCollector;
    }

    public function setMarkerCollector(MarkerCollector $markerCollector): void
    {
        $this->markerCollector = $markerCollector;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param InfoWindow[] $infoWindows
     *
     * @return InfoWindow[]
     */
    public function collect(Map $map, array $infoWindows = [], ?int $strategy = null): array
    {
        if (null === $strategy) {
            $strategy = self::STRATEGY_MAP | self::STRATEGY_MARKER;
        }

        if ($strategy & self::STRATEGY_MAP) {
            $infoWindows = $this->collectValues($map->getOverlayManager()->getInfoWindows(), $infoWindows);
        }

        if ($strategy & self::STRATEGY_MARKER) {
            foreach ($this->markerCollector->collect($map) as $marker) {
                if ($marker->hasInfoWindow()) {
                    $infoWindows = $this->collectValue($marker->getInfoWindow(), $infoWindows);
                }
            }
        }

        return $infoWindows;
    }

    /** {@inheritdoc} */
    protected function collectValue(object $value, array $defaults = []): array
    {
        if (null !== $this->type && $value->getType() !== $this->type) {
            return $defaults;
        }

        return parent::collectValue($value, $defaults);
    }
}
