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

namespace Ivory\GoogleMap\Service\Place\Search\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;

class PlaceSearchResponse
{
    /** @var string|null */
    private $status;

    /** @var PlaceSearchRequestInterface|null */
    private $request;

    /** @var Place[] */
    private $results = [];

    /** @var string[] */
    private $htmlAttributions = [];

    /** @var string|null */
    private $nextPageToken;

    public function hasStatus(): bool
    {
        return null !== $this->status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return null !== $this->request;
    }

    public function getRequest(): ?PlaceSearchRequestInterface
    {
        return $this->request;
    }

    public function setRequest(PlaceSearchRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /** @return Place[] */
    public function getResults(): array
    {
        return $this->results;
    }

    /** @param Place[] $results */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /** @param Place[] $results */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(Place $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(Place $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(Place $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
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

    public function hasNextPageToken(): bool
    {
        return null !== $this->nextPageToken;
    }

    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    public function setNextPageToken(?string $nextPageToken): void
    {
        $this->nextPageToken = $nextPageToken;
    }
}
