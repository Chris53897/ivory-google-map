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

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

class DirectionTransitLine
{
    /** @var string|null */
    private $name;

    /** @var string|null */
    private $shortName;

    /** @var string|null */
    private $color;

    /** @var string|null */
    private $url;

    /** @var string|null */
    private $icon;

    /** @var string|null */
    private $textColor;

    /** @var DirectionTransitVehicle|null */
    private $vehicle;

    /** @var DirectionTransitAgency[] */
    private $agencies = [];

    public function hasName(): bool
    {
        return null !== $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function hasShortName(): bool
    {
        return null !== $this->shortName;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): void
    {
        $this->shortName = $shortName;
    }

    public function hasColor(): bool
    {
        return null !== $this->color;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function hasUrl(): bool
    {
        return null !== $this->url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function hasIcon(): bool
    {
        return null !== $this->icon;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function hasTextColor(): bool
    {
        return null !== $this->textColor;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): void
    {
        $this->textColor = $textColor;
    }

    public function hasVehicle(): bool
    {
        return null !== $this->vehicle;
    }

    public function getVehicle(): ?DirectionTransitVehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(DirectionTransitVehicle $vehicle = null): void
    {
        $this->vehicle = $vehicle;
    }

    public function hasAgencies(): bool
    {
        return !empty($this->agencies);
    }

    /** @return DirectionTransitAgency[] */
    public function getAgencies(): array
    {
        return $this->agencies;
    }

    /** @param DirectionTransitAgency[] $agencies */
    public function setAgencies(array $agencies): void
    {
        $this->agencies = $agencies;
        $this->addAgencies($agencies);
    }

    /** @param DirectionTransitAgency[] $agencies */
    public function addAgencies(array $agencies): void
    {
        foreach ($agencies as $agency) {
            $this->addAgency($agency);
        }
    }

    public function hasAgency(DirectionTransitAgency $agency): bool
    {
        return in_array($agency, $this->agencies, true);
    }

    public function addAgency(DirectionTransitAgency $agency): void
    {
        if (!$this->hasAgency($agency)) {
            $this->agencies[] = $agency;
        }
    }

    public function removeAgency(DirectionTransitAgency $agency): void
    {
        unset($this->agencies[array_search($agency, $this->agencies, true)]);
        $this->agencies = empty($this->agencies) ? [] : array_values($this->agencies);
    }
}
