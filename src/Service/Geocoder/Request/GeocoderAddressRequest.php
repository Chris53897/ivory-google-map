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

use Ivory\GoogleMap\Base\Bound;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 */
class GeocoderAddressRequest extends AbstractGeocoderRequest
{
    /** @var string */
    private $address;

    /** @var array */
    private $components = [];

    /** @var Bound|null */
    private $bound;

    /** @var string|null */
    private $region;

    public function __construct(string $address)
    {
        $this->setAddress($address);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function hasComponents(): bool
    {
        return !empty($this->components);
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function setComponents(array $components): void
    {
        $this->components = [];
        $this->addComponents($components);
    }

    public function addComponents(array $components): void
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    public function hasComponent(string $type): bool
    {
        return isset($this->components[$type]);
    }

    public function getComponent(string $type)
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    public function setComponent(string $type, $value): void
    {
        $this->components[$type] = $value;
    }

    public function removeComponent(string $type): void
    {
        unset($this->components[$type]);
    }

    public function hasBound(): bool
    {
        return null !== $this->bound;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
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

    public function buildQuery(): array
    {
        $query = ['address' => $this->address];

        if ($this->hasComponents()) {
            $query['components'] = implode('|', array_map(static function ($type, $value) {
                return $type.':'.$value;
            }, array_keys($this->components), $this->components));
        }

        if ($this->hasBound()) {
            $query['bound'] = implode('|', [
                $this->buildCoordinate($this->bound->getSouthWest()),
                $this->buildCoordinate($this->bound->getNorthEast()),
            ]);
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        return array_merge($query, parent::buildQuery());
    }
}
