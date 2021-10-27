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

class DirectionTransitVehicle
{
    /** @var string|null */
    private $name;

    /** @var string|null */
    private $icon;

    /** @var string|null */
    private $type;

    /** @var string|null */
    private $localIcon;

    public function hasName(): bool
    {
        return null !== $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function hasIcon(): bool
    {
        return null !== $this->icon;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function hasType(): bool
    {
        return null !== $this->type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function hasLocalIcon(): bool
    {
        return null !== $this->localIcon;
    }

    public function getLocalIcon(): ?string
    {
        return $this->localIcon;
    }

    public function setLocalIcon(?string $localIcon): void
    {
        $this->localIcon = $localIcon;
    }
}
