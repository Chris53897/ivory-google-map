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

namespace Ivory\GoogleMap\Event;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 */
class Event implements VariableAwareInterface
{
    use VariableAwareTrait;

    /** @var string */
    private $instance;

    /** @var string */
    private $trigger;

    /** @var string */
    private $handle;

    /** @var bool */
    private $capture;

    public function __construct(string $instance, string $trigger, string $handle, bool $capture = false)
    {
        $this->setInstance($instance);
        $this->setTrigger($trigger);
        $this->setHandle($handle);
        $this->setCapture($capture);
    }

    public function getInstance(): string
    {
        return $this->instance;
    }

    public function setInstance(string $instance): void
    {
        $this->instance = $instance;
    }

    public function getTrigger(): string
    {
        return $this->trigger;
    }

    public function setTrigger(string $trigger): void
    {
        $this->trigger = $trigger;
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function setHandle($handle): void
    {
        $this->handle = $handle;
    }

    public function isCapture(): bool
    {
        return $this->capture;
    }

    public function setCapture(bool $capture): void
    {
        $this->capture = $capture;
    }
}
