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

interface StaticOptionsAwareInterface
{
    public function hasStaticOptions(): bool;
    public function getStaticOptions(): array;
    public function setStaticOptions(array $options): void;
    public function addStaticOptions(array $options): void;
    public function hasStaticOption(string $option): bool;
    public function getStaticOption(string $option);
    public function setStaticOption(string $option, $value): void;
    public function removeStaticOption(string $option);
}
