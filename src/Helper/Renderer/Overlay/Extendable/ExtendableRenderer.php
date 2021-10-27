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

namespace Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable;

use InvalidArgumentException;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

class ExtendableRenderer implements ExtendableRendererInterface
{
    /** @var ExtendableRendererInterface[] */
    private $renderers = [];

    public function hasRenderers(): bool
    {
        return !empty($this->renderers);
    }

    /**
     * @return ExtendableRendererInterface[]
     */
    public function getRenderers(): array
    {
        return $this->renderers;
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function setRenderers(array $renderers): void
    {
        $this->renderers = [];
        $this->addRenderers($renderers);
    }

    /**
     * @param ExtendableRendererInterface[] $renderers
     */
    public function addRenderers(array $renderers): void
    {
        foreach ($renderers as $name => $renderer) {
            $this->setRenderer($name, $renderer);
        }
    }

    public function hasRenderer(string $name): bool
    {
        return isset($this->renderers[$name]);
    }

    public function getRenderer(string $name): ?ExtendableRendererInterface
    {
        return $this->hasRenderer($name) ? $this->renderers[$name] : null;
    }

    public function setRenderer(string $name, ExtendableRendererInterface $renderer): void
    {
        $this->renderers[$name] = $renderer;
    }

    public function removeRenderer(string $name): void
    {
        unset($this->renderers[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function render(ExtendableInterface $extendable, Bound $bound): string
    {
        $renderer = $this->getRenderer(get_class($extendable));

        if (null === $renderer) {
            throw new InvalidArgumentException(sprintf('The extendable renderer for "%s" could not be found.', get_class($extendable)));
        }

        return $renderer->render($extendable, $bound);
    }
}
