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

namespace Ivory\GoogleMap\Service\Place\Search\Request;

abstract class AbstractTextualPlaceSearchRequest extends AbstractPlaceSearchRequest
{
    /** @var string|null */
    private $keyword;

    public function hasKeyword(): bool
    {
        return null !== $this->keyword;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function buildQuery(): array
    {
        $query = parent::buildQuery();

        if ($this->hasKeyword()) {
            $query['keyword'] = $this->keyword;
        }

        return $query;
    }
}
