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

namespace Ivory\GoogleMap\Service\TimeZone\Request;

use DateTime;
use Ivory\GoogleMap\Base\Coordinate;

class TimeZoneRequest implements TimeZoneRequestInterface
{
    /** @var Coordinate */
    private $location;

    /** @var DateTime */
    private $date;

    /** @var string|null */
    private $language;

    public function __construct(Coordinate $location, DateTime $date)
    {
        $this->setLocation($location);
        $this->setDate($date);
    }

    public function getLocation(): Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function hasLanguage(): bool
    {
        return null !== $this->language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $query = [
            'location' => $this->buildCoordinate($this->location),
            'timestamp' => $this->date->getTimestamp(),
        ];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    private function buildCoordinate(Coordinate $coordinate): string
    {
        return $coordinate->getLatitude().','.$coordinate->getLongitude();
    }
}
