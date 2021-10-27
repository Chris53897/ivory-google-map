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

namespace Ivory\GoogleMap\Place;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

class Autocomplete implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var string */
    private $inputId = 'place_input';

    /** @var EventManager */
    private $eventManager;

    /** @var Bound|null */
    private $bound;

    /** @var string[] */
    private $types = [];

    /** @var array */
    private $components = [];

    /** @var string */
    private $value;

    /** @var string[] */
    private $inputAttributes = [];

    /** @var string[] */
    private $libraries = [];

    public function __construct()
    {
        $this->setEventManager(new EventManager());
    }

    public function getHtmlId(): string
    {
        return $this->inputId;
    }

    public function setInputId(string $inputId): void
    {
        $this->inputId = $inputId;
    }

    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function hasBound(): bool
    {
        return null !== $this->bound;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /** @return string[] */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param string[] $types */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /** @param string[] $types */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function addType(string $type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    public function removeType(string $type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }

    public function hasComponents(): bool
    {
        return !empty($this->components);
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function setComponents(array $components): void
    {
        $this->components = [];
        $this->addComponents($components);
    }

    public function addComponents(array $components): void
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    public function hasComponent(string $type): bool
    {
        return isset($this->components[$type]);
    }

    public function getComponent(string $type)
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    public function setComponent(string $type, $value): void
    {
        $this->components[$type] = $value;
    }

    public function removeComponent(string $type): void
    {
        unset($this->components[$type]);
    }

    public function hasValue(): bool
    {
        return null !== $this->value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value = null): void
    {
        $this->value = $value;
    }

    public function hasInputAttributes(): bool
    {
        return !empty($this->inputAttributes);
    }

    /** @return string[] */
    public function getInputAttributes(): array
    {
        return $this->inputAttributes;
    }

    /** @param string[] $inputAttributes */
    public function setInputAttributes(array $inputAttributes): void
    {
        $this->inputAttributes = [];
        $this->addInputAttributes($inputAttributes);
    }

    /** @param string[] $inputAttributes */
    public function addInputAttributes(array $inputAttributes): void
    {
        foreach ($inputAttributes as $name => $value) {
            $this->setInputAttribute($name, $value);
        }
    }

    public function hasInputAttribute(string $name): bool
    {
        return isset($this->inputAttributes[$name]);
    }

    public function getInputAttribute(string $name): ?string
    {
        return $this->hasInputAttribute($name) ? $this->inputAttributes[$name] : null;
    }

    public function setInputAttribute(string $name, string $value): void
    {
        $this->inputAttributes[$name] = $value;
    }

    public function removeInputAttribute(string $name): void
    {
        unset($this->inputAttributes[$name]);
    }

    public function hasLibraries(): bool
    {
        return !empty($this->libraries);
    }

    /** @return string[] */
    public function getLibraries(): array
    {
        return $this->libraries;
    }

    /** @param string[] $libraries */
    public function setLibraries(array $libraries): void
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /** @param string[] $libraries */
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
}
