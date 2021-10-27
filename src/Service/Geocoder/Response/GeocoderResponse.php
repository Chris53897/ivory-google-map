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

namespace Ivory\GoogleMap\Service\Geocoder\Response;

use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;

class GeocoderResponse
{
    /** @var string|null */
    private $status;

    /** @var GeocoderRequestInterface|null */
    private $request;

    /** @var GeocoderResult[] */
    private $results = [];

    public function hasStatus(): bool
    {
        return null !== $this->status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status = null): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return null !== $this->request;
    }

    public function getRequest(): ?GeocoderRequestInterface
    {
        return $this->request;
    }

    public function setRequest(GeocoderRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /** @return GeocoderResult[] */
    public function getResults(): array
    {
        return $this->results;
    }

    /** @param GeocoderResult[] $results */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /** @param GeocoderResult[] $results */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(GeocoderResult $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(GeocoderResult $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(GeocoderResult $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
    }
}
