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

namespace Ivory\GoogleMap\Helper\Builder;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractHelperBuilder
{
    /** @var EventSubscriberInterface[] */
    private $subscribers = [];

    /** @var string|null */
    protected $key;

    public static function create(?string $key = null): AbstractHelperBuilder
    {
        return (new static())->setKey($key);
    }

    public function hasSubscribers(): bool
    {
        return !empty($this->subscribers);
    }

    /** @return EventSubscriberInterface[] */
    public function getSubscribers(): array
    {
        return $this->subscribers;
    }

    /** @param EventSubscriberInterface[] $subscribers */
    public function setSubscribers(array $subscribers): AbstractHelperBuilder
    {
        $this->subscribers = [];
        $this->addSubscribers($subscribers);

        return $this;
    }

    /** @param EventSubscriberInterface[] $subscribers */
    public function addSubscribers(array $subscribers): AbstractHelperBuilder
    {
        foreach ($subscribers as $subscriber) {
            $this->addSubscriber($subscriber);
        }

        return $this;
    }

    public function hasSubscriber(EventSubscriberInterface $subscriber): bool
    {
        return in_array($subscriber, $this->subscribers, true);
    }

    public function addSubscriber(EventSubscriberInterface $subscriber): AbstractHelperBuilder
    {
        if (!$this->hasSubscriber($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    public function removeSubscriber(EventSubscriberInterface $subscriber): AbstractHelperBuilder
    {
        unset($this->subscribers[array_search($subscriber, $this->subscribers, true)]);
        $this->subscribers = empty($this->subscribers) ? [] : array_values($this->subscribers);

        return $this;
    }

    protected function createEventDispatcher(): EventDispatcher
    {
        $eventDispatcher = new EventDispatcher();

        foreach ($this->createSubscribers() as $subscriber) {
            $eventDispatcher->addSubscriber($subscriber);
        }

        return $eventDispatcher;
    }

    /** @return EventSubscriberInterface[] */
    protected function createSubscribers(): array
    {
        return $this->subscribers;
    }

    public function hasKey(): bool
    {
        return null !== $this->key;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): AbstractHelperBuilder
    {
        $this->key = $key;

        return $this;
    }
}
