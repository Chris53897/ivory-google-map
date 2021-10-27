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

trait VariableAwareTrait
{
    /** @var string|null */
    private $variable;

    public function getVariable(): ?string
    {
        if (null === $this->variable) {
            $prefix         = strtolower(substr(strrchr(get_class($this), '\\'), 1));
            $this->variable = $prefix.substr_replace(uniqid('', true), '', 14, 1);
        }

        return $this->variable;
    }

    public function setVariable(string $variable): void
    {
        $this->variable = $variable;
    }
}
