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

namespace Ivory\GoogleMap\Helper\Collector;

abstract class AbstractCollector
{
    protected function collectValues(array $values, array $defaults = []): array
    {
        foreach ($values as $value) {
            $defaults = $this->collectValue($value, $defaults);
        }

        return $defaults;
    }

    /**
     * @param object[] $defaults
     *
     * @return object[]
     */
    protected function collectValue(object $value, array $defaults = []): array
    {
        if (!in_array($value, $defaults, true)) {
            $defaults[] = $value;
        }

        return $defaults;
    }
}
