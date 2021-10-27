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

namespace Ivory\GoogleMap\Service\Place\Photo\Request;

class PlacePhotoRequest implements PlacePhotoRequestInterface
{
    /** @var string */
    private $reference;

    /** @var int|null */
    private $maxWidth;

    /** @var int|null */
    private $maxHeight;

    public function __construct(string $reference)
    {
        $this->setReference($reference);
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function hasMaxWidth(): bool
    {
        return null !== $this->maxWidth;
    }

    public function getMaxWidth(): ?int
    {
        return $this->maxWidth;
    }

    public function setMaxWidth(?int $maxWidth): void
    {
        $this->maxWidth = $maxWidth;
    }

    public function hasMaxHeight(): bool
    {
        return null !== $this->maxHeight;
    }

    public function getMaxHeight(): ?int
    {
        return $this->maxHeight;
    }

    public function setMaxHeight(?int $maxHeight): void
    {
        $this->maxHeight = $maxHeight;
    }

    public function buildQuery(): array
    {
        $query = ['photoreference' => $this->reference];

        if ($this->hasMaxWidth()) {
            $query['maxwidth'] = $this->maxWidth;
        }

        if ($this->hasMaxHeight()) {
            $query['maxheight'] = $this->maxHeight;
        }

        return $query;
    }
}
