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

namespace Ivory\GoogleMap\Helper\Event;

use Ivory\GoogleMap\Map;
use Symfony\Contracts\EventDispatcher\Event;

class StaticMapEvent extends Event
{
    /** @var Map */
    private $map;

    private $parameters = [];

    public function __construct(Map $map, array $parameters = [])
    {
        $this->map = $map;
        $this->setParameters($parameters);
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function hasParameters(): bool
    {
        return !empty($this->parameters);
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = [];
        $this->addParameters($parameters);
    }

    public function addParameters(array $parameters): void
    {
        foreach ($parameters as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }
    }

    public function hasParameter(string $parameter): bool
    {
        return isset($this->parameters[$parameter]);
    }

    public function getParameter(string $parameter)
    {
        return $this->hasParameter($parameter) ? $this->parameters[$parameter] : null;
    }

    public function setParameter(string $parameter, $value): void
    {
        $this->parameters[$parameter] = $value;
    }

    public function removeParameter(string $parameter): void
    {
        unset($this->parameters[$parameter]);
    }
}
