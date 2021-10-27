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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 */
class InfoWindow implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /** @var string */
    private $content;

    /** @var string */
    private $type = InfoWindowType::DEFAULT_;

    /** @var Coordinate|null */
    private $position;

    /** @var Size|null */
    private $pixedOffset;

    /** @var bool */
    private $open = false;

    /** @var string */
    private $openEvent = MouseEvent::CLICK;

    /** @var bool */
    private $autoOpen = true;

    /** @var bool */
    private $autoClose = true;

    public function __construct(string $content, string $type = InfoWindowType::DEFAULT_, Coordinate $position = null)
    {
        $this->setContent($content);
        $this->setType($type);
        $this->setPosition($position);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function hasPosition(): bool
    {
        return null !== $this->position;
    }

    public function getPosition(): ?Coordinate
    {
        return $this->position;
    }

    public function setPosition(Coordinate $position = null): void
    {
        $this->position = $position;
    }

    public function hasPixelOffset(): bool
    {
        return null !== $this->pixedOffset;
    }

    public function getPixelOffset(): ?Size
    {
        return $this->pixedOffset;
    }

    public function setPixelOffset(Size $pixelOffset = null): void
    {
        $this->pixedOffset = $pixelOffset;
    }

    public function isOpen(): bool
    {
        return $this->open;
    }

    public function setOpen($open): void
    {
        $this->open = $open;
    }

    public function isAutoOpen(): bool
    {
        return $this->autoOpen;
    }

    public function setAutoOpen(bool $autoOpen): void
    {
        $this->autoOpen = $autoOpen;
    }

    public function getOpenEvent(): string
    {
        return $this->openEvent;
    }

    public function setOpenEvent(string $openEvent): void
    {
        $this->openEvent = $openEvent;
    }

    public function isAutoClose(): bool
    {
        return $this->autoClose;
    }

    public function setAutoClose(bool $autoClose): void
    {
        $this->autoClose = $autoClose;
    }
}
