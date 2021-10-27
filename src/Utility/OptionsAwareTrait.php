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

namespace Ivory\GoogleMap\Utility;

trait OptionsAwareTrait
{
    /** @var array */
    private $options = [];

    public function hasOptions(): bool
    {
        return !empty($this->options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): void
    {
        $this->options = [];
        $this->addOptions($options);
    }

    public function addOptions(array $options): void
    {
        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }
    }

    public function hasOption($option): bool
    {
        return isset($this->options[$option]);
    }

    public function getOption(string $option)
    {
        return $this->hasOption($option) ? $this->options[$option] : null;
    }

    public function setOption(string $option, $value): void
    {
        $this->options[$option] = $value;
    }

    public function removeOption(string $option): void
    {
        unset($this->options[$option]);
    }
}
