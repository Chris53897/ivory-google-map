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

interface OptionsAwareInterface
{
    public function hasOptions(): bool;
    public function getOptions(): array;
    public function setOptions(array $options): void;
    public function addOptions(array $options): void;
    public function hasOption(string $option): bool;
    public function getOption(string $option);
    public function setOption(string $option, $value);
    public function removeOption(string $option): void;
}
