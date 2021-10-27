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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Icon
 */
class Icon implements VariableAwareInterface
{
    public const DEFAULT_URL = 'https://maps.gstatic.com/mapfiles/markers/marker.png';

    use VariableAwareTrait;

    /** @var string */
    private $url;

    /** @var Point|null */
    private $anchor;

    /** @var Point|null */
    private $origin;

    /** @var Size|null */
    private $scaledSize;

    /** @var Size|null */
    private $size;

    /** @var Point|null */
    private $labelOrigin;

    public function __construct(
        string $url = self::DEFAULT_URL,
        Point  $anchor = null,
        Point  $origin = null,
        Size   $scaledSize = null,
        Size   $size = null,
        Point  $labelOrigin = null
    ) {
        $this->setUrl($url);
        $this->setAnchor($anchor);
        $this->setOrigin($origin);
        $this->setScaledSize($scaledSize);
        $this->setSize($size);
        $this->setLabelOrigin($labelOrigin);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function hasAnchor(): bool
    {
        return null !== $this->anchor;
    }

    public function getAnchor(): ?Point
    {
        return $this->anchor;
    }

    public function setAnchor(Point $anchor = null): void
    {
        $this->anchor = $anchor;
    }

    public function hasOrigin(): bool
    {
        return null !== $this->origin;
    }

    public function getOrigin(): ?Point
    {
        return $this->origin;
    }

    public function setOrigin(Point $origin = null): void
    {
        $this->origin = $origin;
    }

    public function hasScaledSize(): bool
    {
        return null !== $this->scaledSize;
    }

    public function getScaledSize(): ?Size
    {
        return $this->scaledSize;
    }

    public function setScaledSize(Size $scaledSize = null): void
    {
        $this->scaledSize = $scaledSize;
    }

    public function hasSize(): bool
    {
        return null !== $this->size;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(Size $size = null): void
    {
        $this->size = $size;
    }

    public function hasLabelOrigin(): bool
    {
        return null !== $this->labelOrigin;
    }

    public function getLabelOrigin(): ?Point
    {
        return $this->labelOrigin;
    }

    public function setLabelOrigin(Point $labelOrigin = null): void
    {
        $this->labelOrigin = $labelOrigin;
    }

}
