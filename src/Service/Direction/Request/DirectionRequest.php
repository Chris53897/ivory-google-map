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

namespace Ivory\GoogleMap\Service\Direction\Request;

use DateTime;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionRequest
 */
class DirectionRequest implements DirectionRequestInterface
{
    /** @var LocationInterface */
    private $origin;

    /** @var LocationInterface */
    private $destination;

    /** @var DateTime|null */
    private $departureTime;

    /** @var DateTime|null */
    private $arrivalTime;

    /** @var DirectionWaypoint[] */
    private $waypoints = [];

    /** @var bool|null */
    private $optimizeWaypoints;

    /** @var string|null */
    private $travelMode;

    /** @var string|null */
    private $avoid;

    /** @var bool|null */
    private $provideRouteAlternatives;

    /** @var string|null */
    private $trafficModel;

    /** @var string[] */
    private $transitModes = [];

    /** @var string|null */
    private $transitRoutingPreference;

    /** @var string|null */
    private $region;

    /** @var string|null */
    private $unitSystem;

    /** @var string|null */
    private $language;

    public function __construct(LocationInterface $origin, LocationInterface $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
    }

    public function getOrigin(): LocationInterface
    {
        return $this->origin;
    }

    public function setOrigin(LocationInterface $origin): void
    {
        $this->origin = $origin;
    }

    public function getDestination(): LocationInterface
    {
        return $this->destination;
    }

    public function setDestination(LocationInterface $destination): void
    {
        $this->destination = $destination;
    }

    public function hasDepartureTime(): bool
    {
        return null !== $this->departureTime;
    }

    public function getDepartureTime(): ?DateTime
    {
        return $this->departureTime;
    }

    public function setDepartureTime(DateTime $departureTime = null): void
    {
        $this->departureTime = $departureTime;
    }

    public function hasArrivalTime(): bool
    {
        return null !== $this->arrivalTime;
    }

    public function getArrivalTime(): ?DateTime
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(DateTime $arrivalTime = null): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function hasWaypoints(): bool
    {
        return !empty($this->waypoints);
    }

    /** @return DirectionWaypoint[] */
    public function getWaypoints(): array
    {
        return $this->waypoints;
    }

    /** @param DirectionWaypoint[] $waypoints */
    public function setWaypoints(array $waypoints): void
    {
        $this->waypoints = [];
        $this->addWaypoints($waypoints);
    }

    /** @param DirectionWaypoint[] $waypoints */
    public function addWaypoints(array $waypoints): void
    {
        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    public function hasWaypoint(DirectionWaypoint $waypoint): bool
    {
        return in_array($waypoint, $this->waypoints, true);
    }

    public function addWaypoint(DirectionWaypoint $waypoint): void
    {
        if (!$this->hasWaypoint($waypoint)) {
            $this->waypoints[] = $waypoint;
        }
    }

    public function removeWaypoint(DirectionWaypoint $waypoint): void
    {
        unset($this->waypoints[array_search($waypoint, $this->waypoints, true)]);
        $this->waypoints = empty($this->waypoints) ? [] : array_values($this->waypoints);
    }

    public function hasOptimizeWaypoints(): bool
    {
        return null !== $this->optimizeWaypoints;
    }

    public function getOptimizeWaypoints(): ?bool
    {
        return $this->optimizeWaypoints;
    }

    public function setOptimizeWaypoints(?bool $optimizeWaypoints = null): void
    {
        $this->optimizeWaypoints = $optimizeWaypoints;
    }

    public function hasTravelMode(): bool
    {
        return null !== $this->travelMode;
    }

    public function getTravelMode(): ?string
    {
        return $this->travelMode;
    }

    public function setTravelMode(?string $travelMode = null): void
    {
        $this->travelMode = $travelMode;
    }

    public function hasAvoid(): bool
    {
        return null !== $this->avoid;
    }

    public function getAvoid(): ?string
    {
        return $this->avoid;
    }

    public function setAvoid(?string $avoid = null): void
    {
        $this->avoid = $avoid;
    }

    public function hasProvideRouteAlternatives(): bool
    {
        return null !== $this->provideRouteAlternatives;
    }

    public function getProvideRouteAlternatives(): ?bool
    {
        return $this->provideRouteAlternatives;
    }

    public function setProvideRouteAlternatives(?bool $provideRouteAlternatives = null): void
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;
    }

    public function hasTrafficModel(): bool
    {
        return null !== $this->trafficModel;
    }

    public function getTrafficModel(): ?string
    {
        return $this->trafficModel;
    }

    public function setTrafficModel(?string $trafficModel): void
    {
        $this->trafficModel = $trafficModel;
    }

    public function hasTransitModes(): bool
    {
        return !empty($this->transitModes);
    }

    /** @return string[] */
    public function getTransitModes(): array
    {
        return $this->transitModes;
    }

    /** @param string[] $transitModes */
    public function setTransitModes(array $transitModes): void
    {
        $this->transitModes = [];
        $this->addTransitModes($transitModes);
    }

    /** @param string[] $transitModes */
    public function addTransitModes(array $transitModes): void
    {
        foreach ($transitModes as $transitMode) {
            $this->addTransitMode($transitMode);
        }
    }

    public function hasTransitMode(string $transitMode): bool
    {
        return in_array($transitMode, $this->transitModes, true);
    }

    public function addTransitMode(string $transitMode): void
    {
        if (!$this->hasTransitMode($transitMode)) {
            $this->transitModes[] = $transitMode;
        }
    }

    public function removeTransitMode(string $transitMode): void
    {
        unset($this->transitModes[array_search($transitMode, $this->transitModes, true)]);
        $this->transitModes = empty($this->transitModes) ? [] : array_values($this->transitModes);
    }

    public function hasTransitRoutingPreference(): bool
    {
        return null !== $this->transitRoutingPreference;
    }

    public function getTransitRoutingPreference(): ?string
    {
        return $this->transitRoutingPreference;
    }

    public function setTransitRoutingPreference(?string $transitRoutingPreference): void
    {
        $this->transitRoutingPreference = $transitRoutingPreference;
    }

    public function hasRegion(): bool
    {
        return null !== $this->region;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region = null): void
    {
        $this->region = $region;
    }

    public function hasUnitSystem(): bool
    {
        return null !== $this->unitSystem;
    }

    public function getUnitSystem(): ?string
    {
        return $this->unitSystem;
    }

    public function setUnitSystem(?string $unitSystem = null): void
    {
        $this->unitSystem = $unitSystem;
    }

    public function hasLanguage(): bool
    {
        return null !== $this->language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language = null): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $query = [
            'origin'      => $this->origin->buildQuery(),
            'destination' => $this->destination->buildQuery(),
        ];

        if ($this->hasDepartureTime()) {
            $query['departure_time'] = $this->departureTime->getTimestamp();
        }

        if ($this->hasArrivalTime()) {
            $query['arrival_time'] = $this->arrivalTime->getTimestamp();
        }

        if ($this->hasWaypoints()) {
            $waypoints = [];

            if ($this->optimizeWaypoints) {
                $waypoints[] = 'optimize:true';
            }

            foreach ($this->waypoints as $waypoint) {
                $waypoints[] = ($waypoint->getStopover() ? 'via:' : '').$waypoint->getLocation()->buildQuery();
            }

            $query['waypoints'] = implode('|', $waypoints);
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->hasAvoid()) {
            $query['avoid'] = $this->avoid;
        }

        if ($this->hasProvideRouteAlternatives()) {
            $query['alternatives'] = $this->provideRouteAlternatives ? 'true' : 'false';
        }

        if ($this->hasTrafficModel()) {
            $query['traffic_model'] = $this->trafficModel;
        }

        if ($this->hasTransitModes()) {
            $query['transit_mode'] = implode('|', $this->transitModes);
        }

        if ($this->hasTransitRoutingPreference()) {
            $query['transit_routing_preference'] = $this->transitRoutingPreference;
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasUnitSystem()) {
            $query['units'] = strtolower($this->unitSystem);
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }
}
