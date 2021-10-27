<?php

declare(strict_types=1);

namespace Ivory\Tests\GoogleMap\Service\Utility;

use ArrayAccess;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;
use Ivory\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class History implements ArrayAccess
{
    private $container;
    private $serializer;
    private $context;
    private $accessorIterator = 0;

    public function __construct()
    {
        $this->container = [];
        $this->serializer = new Serializer();
        $this->context = (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy());
    }

    public function getData(): ?array
    {
        $body = $this->container[$this->accessorIterator++]['response']->getBody();
        $body->rewind();

        $data = $body->getContents();

        return $this->serializer->deserialize(
            $data,
            'array',
            'json',
            $this->context);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->getFirst()['response'];
    }

    public function count(): int
    {
        return count($this->container);
    }

    public function getFirst()
    {
        return $this->container[array_key_first($this->container)];
    }

    public function getLast()
    {
        return $this->container[array_key_last($this->container)];
    }

    public function clear(): void
    {
        $this->container = [];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }
}
