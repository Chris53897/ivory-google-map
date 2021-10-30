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

namespace Ivory\GoogleMap\Service\Place\Base;

class Photo
{
    /** @var string|null */
    private $reference;

    /** @var int|null */
    private $width;

    /** @var int|null */
    private $height;

    /** @var string[] */
    private $htmlAttributions = [];

    public function hasReference(): bool
    {
        return null !== $this->reference;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    public function hasWidth(): bool
    {
        return null !== $this->width;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function hasHeight(): bool
    {
        return null !== $this->height;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    public function hasHtmlAttributions(): bool
    {
        return !empty($this->htmlAttributions);
    }

    /** @return string[] */
    public function getHtmlAttributions(): array
    {
        return $this->htmlAttributions;
    }

    /** @param string[] $htmlAttributions */
    public function setHtmlAttributions(array $htmlAttributions): void
    {
        $this->htmlAttributions = [];
        $this->addHtmlAttributions($htmlAttributions);
    }

    /** @param string[] $htmlAttributions */
    public function addHtmlAttributions(array $htmlAttributions): void
    {
        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }
    }

    public function hasHtmlAttribution(string $htmlAttribution): bool
    {
        return in_array($htmlAttribution, $this->htmlAttributions, true);
    }

    public function addHtmlAttribution(string $htmlAttribution): void
    {
        if (!$this->hasHtmlAttribution($htmlAttribution)) {
            $this->htmlAttributions[] = $htmlAttribution;
        }
    }

    public function removeHtmlAttribution(string $htmlAttribution): void
    {
        unset($this->htmlAttributions[array_search($htmlAttribution, $this->htmlAttributions, true)]);
        $this->htmlAttributions = empty($this->htmlAttributions) ? [] : array_values($this->htmlAttributions);
    }
}
