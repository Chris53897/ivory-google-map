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

namespace Ivory\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;

class ElevationResponse
{
    /** @var string|null */
    private $status;

    /** @var ElevationRequestInterface|null */
    private $request;

    /** @var ElevationResult[] */
    private $results = [];

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

    public function getRequest(): ?ElevationRequestInterface
    {
        return $this->request;
    }

    public function setRequest(ElevationRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /** @return ElevationResult[] */
    public function getResults(): array
    {
        return $this->results;
    }

    /** @param ElevationResult[] $results */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /** @param ElevationResult[] $results */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(ElevationResult $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(ElevationResult $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(ElevationResult $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
    }
}
