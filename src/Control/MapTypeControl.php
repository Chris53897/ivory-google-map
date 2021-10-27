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

use Ivory\GoogleMap\MapTypeId;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeControlOptions
 */
class MapTypeControl
{
    /** @var string[] */
    private $ids = [];

    /** @var string */
    private $position;

    /** @var string */
    private $style;

    /** @param string[] $ids */
    public function __construct(
        array $ids = [MapTypeId::ROADMAP, MapTypeId::SATELLITE],
        string $position = ControlPosition::TOP_RIGHT,
        string $style = MapTypeControlStyle::DEFAULT_
    ) {
        $this->addIds($ids);
        $this->setPosition($position);
        $this->setStyle($style);
    }

    public function hasIds(): bool
    {
        return !empty($this->ids);
    }

    /** @return string[] */
    public function getIds(): array
    {
        return $this->ids;
    }

    /** @param string[] $ids */
    public function setIds(array $ids): void
    {
        $this->ids = [];
        $this->addIds($ids);
    }

    /** @param string[] $ids */
    public function addIds(array $ids): void
    {
        foreach ($ids as $mapTypeId) {
            $this->addId($mapTypeId);
        }
    }

    public function hasId(string $id): bool
    {
        return in_array($id, $this->ids, true);
    }

    public function addId(string $id): void
    {
        if (!$this->hasId($id)) {
            $this->ids[] = $id;
        }
    }

    public function removeId(string $id): void
    {
        unset($this->ids[array_search($id, $this->ids, true)]);
        $this->ids = empty($this->ids) ? [] : array_values($this->ids);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function setStyle(string $style): void
    {
        $this->style = $style;
    }
}
