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

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 */
class MarkerShape implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var string */
    private $type;

    /** @var float[] */
    private $coordinates = [];

    /**
     * @param float[] $coordinates
     */
    public function __construct(string $type, array $coordinates)
    {
        $this->setType($type);
        $this->addCoordinates($coordinates);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function hasCoordinates(): bool
    {
        return !empty($this->coordinates);
    }

    /**
     * @return float[]
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param float[] $coordinates
     */
    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param float[] $coordinates
     */
    public function addCoordinates(array $coordinates): void
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    public function hasCoordinate(float $coordinate): bool
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    public function addCoordinate(float $coordinate): void
    {
        $this->coordinates[] = $coordinate;
    }
}
