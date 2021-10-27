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

use SplObjectStorage;

class ApiEvent extends AbstractEvent
{
    /** @var object[] */
    private $objects;

    /** @var string[] */
    private $sources = [];

    /** @var string[] */
    private $libraries = [];

    /** @var SplObjectStorage */
    private $callbacks;

    /** @var SplObjectStorage */
    private $requirements;

    /**
     * @param object[] $objects
     */
    public function __construct(array $objects)
    {
        $this->objects = $objects;
        $this->callbacks = new SplObjectStorage();
        $this->requirements = new SplObjectStorage();
    }

    public function hasObjects(?string $class = null): bool
    {
        $objects = $this->getObjects($class);

        return !empty($objects);
    }

    /**
     * @return object[]
     */
    public function getObjects(?string $class = null): array
    {
        if (null === $class) {
            return $this->objects;
        }

        $objects = [];

        foreach ($this->objects as $object) {
            if ($object instanceof $class) {
                $objects[] = $object;
            }
        }

        return $objects;
    }

    public function hasSources(): bool
    {
        return !empty($this->sources);
    }

    /**
     * @return string[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param string[] $sources
     */
    public function setSources(array $sources): void
    {
        $this->sources = [];
        $this->addSources($sources);
    }

    /**
     * @param string[] $sources
     */
    public function addSources(array $sources): void
    {
        foreach ($sources as $source) {
            $this->addSource($source);
        }
    }

    public function hasSource(string $source): bool
    {
        return in_array($source, $this->sources, true);
    }

    public function addSource(string $source): void
    {
        if (!$this->hasSource($source)) {
            $this->sources[] = $source;
        }
    }

    public function removeSource(string $source): void
    {
        unset($this->sources[array_search($source, $this->sources, true)]);
        $this->sources = empty($this->sources) ? [] : array_values($this->sources);
    }

    public function hasLibraries(): bool
    {
        return !empty($this->libraries);
    }

    /**
     * @return string[]
     */
    public function getLibraries(): array
    {
        return $this->libraries;
    }

    /**
     * @param string[] $libraries
     */
    public function setLibraries(array $libraries): void
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /**
     * @param string[] $libraries
     */
    public function addLibraries(array $libraries): void
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    public function hasLibrary(string $library): bool
    {
        return in_array($library, $this->libraries, true);
    }

    public function addLibrary(string $library): void
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    public function removeLibrary(string $library): void
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
        $this->libraries = empty($this->libraries) ? [] : array_values($this->libraries);
    }

    public function hasCallbacks(): bool
    {
        return count($this->callbacks) > 0;
    }

    public function getCallbacks(): SplObjectStorage
    {
        return $this->callbacks;
    }

    public function hasCallback(string $callback, ?object $object = null): bool
    {
        foreach ($this->callbacks as $rawObject) {
            if ($this->callbacks[$rawObject] === $callback && (null === $object || $object === $rawObject)) {
                return true;
            }
        }

        return false;
    }

    public function hasCallbackObject(object $object, ?string $callback = null): bool
    {
        return isset($this->callbacks[$object]) && (null === $callback || $this->callbacks[$object] === $callback);
    }

    public function getCallback(object $object): ?string
    {
        return $this->hasCallbackObject($object) ? $this->callbacks[$object] : null;
    }

    public function getCallbackObject(string $callback): ?object
    {
        foreach ($this->callbacks as $object) {
            if ($this->callbacks[$object] === $callback) {
                return $object;
            }
        }

        return null;
    }

    public function addCallback(object $object, string $callback): void
    {
        if (!$this->hasCallback($callback, $object)) {
            $this->callbacks[$object] = $callback;
        }
    }

    public function removeCallbackObject(object $object): void
    {
        unset($this->callbacks[$object]);
    }

    public function removeCallback(string $callback): void
    {
        if ($this->hasCallback($callback)) {
            $this->removeCallbackObject($this->getCallbackObject($callback));
        }
    }

    public function hasRequirements(?object $object = null): bool
    {
        if (null === $object) {
            return count($this->requirements) > 0;
        }

        $requirements = $this->getRequirementsObject($object);

        return !empty($requirements);
    }

    public function getRequirements(): SplObjectStorage
    {
        return $this->requirements;
    }

    /**
     * @return string[]
     */
    public function getRequirementsObject(object $object): array
    {
        return $this->hasRequirement($object) ? $this->requirements[$object] : [];
    }

    /**
     * @param string[] $requirements
     */
    public function setRequirements(object $object, array $requirements): void
    {
        $this->requirements = new SplObjectStorage();
        $this->addRequirements($object, $requirements);
    }

    /**
     * @param string[] $requirements
     */
    public function addRequirements(object $object, array $requirements): void
    {
        foreach ($requirements as $requirement) {
            $this->addRequirement($object, $requirement);
        }
    }

    public function hasRequirement(object $object, ?string $requirement = null): bool
    {
        return isset($this->requirements[$object])
            && (null === $requirement || in_array($requirement, $this->requirements[$object], true));
    }

    public function addRequirement(object $object, string $requirement): void
    {
        if (!$this->hasRequirement($object)) {
            $this->requirements[$object] = [];
        }

        if (!$this->hasRequirement($object, $requirement)) {
            $this->requirements[$object] = array_merge(
                $this->requirements[$object],
                [$requirement]
            );
        }
    }

    public function removeRequirement(object $object, ?string $requirement = null): void
    {
        if (null === $requirement) {
            unset($this->requirements[$object]);

            return;
        }

        if ($this->hasRequirement($object, $requirement)) {
            $requirements = $this->requirements[$object];
            unset($requirements[array_search($requirement, $requirements, true)]);

            if (!empty($requirements)) {
                $this->requirements[$object] = array_values($requirements);
            } else {
                $this->removeRequirement($object);
            }
        }
    }
}
