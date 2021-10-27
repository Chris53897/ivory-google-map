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

namespace Ivory\GoogleMap\Service\DistanceMatrix\Request;

use DateTime;
use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixRequest
 */
class DistanceMatrixRequest implements DistanceMatrixRequestInterface
{
    /** @var LocationInterface[] */
    private $origins = [];

    /** @var LocationInterface[] */
    private $destinations = [];

    /** @var DateTime|null */
    private $departureTime;

    /** @var DateTime|null */
    private $arrivalTime;

    /** @var string|null */
    private $travelMode;

    /** @var string|null */
    private $avoid;

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

    /**
     * @param LocationInterface[] $origins
     * @param LocationInterface[] $destinations
     */
    public function __construct(array $origins, array $destinations)
    {
        $this->setOrigins($origins);
        $this->setDestinations($destinations);
    }

    public function hasOrigins(): bool
    {
        return !empty($this->origins);
    }

    /** @return LocationInterface[] */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /** @param LocationInterface[] $origins */
    public function setOrigins(array $origins): void
    {
        $this->origins = [];
        $this->addOrigins($origins);
    }

    /** @param LocationInterface[] $origins */
    public function addOrigins(array $origins): void
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    public function hasOrigin(LocationInterface $origin): bool
    {
        return in_array($origin, $this->origins, true);
    }

    public function addOrigin(LocationInterface $origin): void
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    public function removeOrigin(LocationInterface $origin): void
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
        $this->origins = empty($this->origins) ? [] : array_values($this->origins);
    }

    public function hasDestinations(): bool
    {
        return !empty($this->destinations);
    }

    /** @return LocationInterface[] */
    public function getDestinations(): array
    {
        return $this->destinations;
    }

    /** @param LocationInterface[] $destinations */
    public function setDestinations(array $destinations): void
    {
        $this->destinations = [];
        $this->addDestinations($destinations);
    }

    /** @param LocationInterface[] $destinations */
    public function addDestinations(array $destinations): void
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    public function hasDestination(LocationInterface $destination): bool
    {
        return in_array($destination, $this->destinations, true);
    }

    public function addDestination(LocationInterface $destination): void
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    public function removeDestination(LocationInterface $destination): void
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
        $this->destinations = empty($this->destinations) ? [] : array_values($this->destinations);
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

    public function hasTravelMode(): bool
    {
        return null !== $this->travelMode;
    }

    public function getTravelMode(): ?string
    {
        return $this->travelMode;
    }

    public function setTravelMode(string $travelMode = null): void
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

    public function setAvoid(string $avoid = null): void
    {
        $this->avoid = $avoid;
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

    public function setRegion(string $region = null): void
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

    public function setUnitSystem(string $unitSystem = null): void
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

    public function setLanguage(string $language = null): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $locationBuilder = static function (LocationInterface $location) {
            $result = $location->buildQuery();

            if ($location instanceof EncodedPolylineLocation) {
                $result .= ':';
            }

            return $result;
        };

        $query = [
            'origins'      => implode('|', array_map($locationBuilder, $this->origins)),
            'destinations' => implode('|', array_map($locationBuilder, $this->destinations)),
        ];

        if ($this->hasDepartureTime()) {
            $query['departure_time'] = $this->departureTime->getTimestamp();
        }

        if ($this->hasArrivalTime()) {
            $query['arrival_time'] = $this->arrivalTime->getTimestamp();
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->hasAvoid()) {
            $query['avoid'] = $this->avoid;
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

        if ($this->hasUnitSystem()) {
            $query['units'] = strtolower($this->unitSystem);
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }
}
