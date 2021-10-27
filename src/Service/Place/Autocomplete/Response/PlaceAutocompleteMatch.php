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

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

class PlaceAutocompleteMatch
{
    /** @var int|null */
    private $length;

    /** @var int|null */
    private $offset;

    public function hasLength(): bool
    {
        return null !== $this->length;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): void
    {
        $this->length = $length;
    }

    public function hasOffset(): bool
    {
        return null !== $this->offset;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset($offset): void
    {
        $this->offset = $offset;
    }
}
