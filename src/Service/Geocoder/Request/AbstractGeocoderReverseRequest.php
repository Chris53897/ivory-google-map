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

namespace Ivory\GoogleMap\Service\Geocoder\Request;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 */
abstract class AbstractGeocoderReverseRequest extends AbstractGeocoderRequest
{
    /** @var string[] */
    private $resultTypes = [];

    /** @var string[] */
    private $locationTypes = [];

    public function hasResultTypes(): bool
    {
        return !empty($this->resultTypes);
    }

    public function getResultTypes(): array
    {
        return $this->resultTypes;
    }

    /** @param string[] $resultTypes */
    public function setResultTypes(array $resultTypes): void
    {
        $this->resultTypes = [];
        $this->addResultTypes($resultTypes);
    }

    /** @param string[] $resultTypes */
    public function addResultTypes(array $resultTypes): void
    {
        foreach ($resultTypes as $resultType) {
            $this->addResultType($resultType);
        }
    }

    public function hasResultType(string $resultType): bool
    {
        return in_array($resultType, $this->resultTypes, true);
    }

    public function addResultType(string $resultType): void
    {
        if (!$this->hasResultType($resultType)) {
            $this->resultTypes[] = $resultType;
        }
    }

    public function removeResultType(string $resultType): void
    {
        unset($this->resultTypes[array_search($resultType, $this->resultTypes, true)]);
        $this->resultTypes = empty($this->resultTypes) ? [] : array_values($this->resultTypes);
    }

    public function hasLocationTypes(): bool
    {
        return !empty($this->locationTypes);
    }

    /** @return string[] */
    public function getLocationTypes(): array
    {
        return $this->locationTypes;
    }

    /** @param string[] $locationTypes */
    public function setLocationTypes(array $locationTypes): void
    {
        $this->locationTypes = [];
        $this->addLocationTypes($locationTypes);
    }

    /** @param string[] $locationTypes */
    public function addLocationTypes(array $locationTypes): void
    {
        foreach ($locationTypes as $locationType) {
            $this->addLocationType($locationType);
        }
    }

    public function hasLocationType(string $locationType): bool
    {
        return in_array($locationType, $this->locationTypes, true);
    }

    public function addLocationType(string $locationType): void
    {
        if (!$this->hasLocationType($locationType)) {
            $this->locationTypes[] = $locationType;
        }
    }

    public function removeLocationType(string $locationType): void
    {
        unset($this->locationTypes[array_search($locationType, $this->locationTypes, true)]);
        $this->locationTypes = empty($this->locationTypes) ? [] : array_values($this->locationTypes);
    }

    public function buildQuery(): array
    {
        $query = [];

        if ($this->hasResultTypes()) {
            $query['result_type'] = implode('|', $this->resultTypes);
        }

        if ($this->hasLocationTypes()) {
            $query['location_type'] = implode('|', $this->locationTypes);
        }

        return array_merge(parent::buildQuery(), $query);
    }
}
