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

trait StaticOptionsAwareTrait
{
    /** @var array */
    private $staticOptions = [];

    public function hasStaticOptions(): bool
    {
        return !empty($this->staticOptions);
    }

    public function getStaticOptions(): array
    {
        return $this->staticOptions;
    }

    public function setStaticOptions(array $options): void
    {
        $this->staticOptions = [];
        $this->addStaticOptions($options);
    }

    public function addStaticOptions(array $options): void
    {
        foreach ($options as $option => $value) {
            $this->setStaticOption($option, $value);
        }
    }

    public function hasStaticOption(string $option): bool
    {
        return isset($this->staticOptions[$option]);
    }

    public function getStaticOption(string $option)
    {
        return $this->hasStaticOption($option) ? $this->staticOptions[$option] : null;
    }

    public function setStaticOption(string $option, $value): void
    {
        $this->staticOptions[$option] = $value;
    }

    public function removeStaticOption(string $option): void
    {
        unset($this->staticOptions[$option]);
    }
}
