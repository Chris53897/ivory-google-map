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

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\ControlManager;
use Ivory\JsonBuilder\JsonBuilder;

class ControlManagerRenderer
{
    /** @var ControlRendererInterface[] */
    private $renderers = [];

    public function hasRenderers(): bool
    {
        return !empty($this->renderers);
    }

    /**
     * @return ControlRendererInterface[]
     */
    public function getRenderers(): array
    {
        return $this->renderers;
    }

    /**
     * @param ControlRendererInterface[] $renderers
     */
    public function setRenderers(array $renderers): void
    {
        $this->renderers = [];
        $this->addRenderers($renderers);
    }

    /**
     * @param ControlRendererInterface[] $renderers
     */
    public function addRenderers(array $renderers): void
    {
        foreach ($renderers as $renderer) {
            $this->addRenderer($renderer);
        }
    }

    public function hasRenderer(ControlRendererInterface $renderer): bool
    {
        return in_array($renderer, $this->renderers, true);
    }

    public function addRenderer(ControlRendererInterface $renderer): void
    {
        if (!$this->hasRenderer($renderer)) {
            $this->renderers[] = $renderer;
        }
    }

    public function removeRenderer(ControlRendererInterface $renderer): void
    {
        unset($this->renderers[array_search($renderer, $this->renderers, true)]);
        $this->renderers = empty($this->renderers) ? [] : array_values($this->renderers);
    }

    public function render(ControlManager $controlManager, JsonBuilder $jsonBuilder): void
    {
        foreach ($this->renderers as $renderer) {
            $control = get_class($renderer);

            if (false !== ($position = strrpos($control, '\\'))) {
                $control = substr($control, ++$position, -8);
            }

            if ($controlManager->{'has'.$control}()) {
                $lcControl = lcfirst($control);

                $jsonBuilder
                    ->setValue('['.$lcControl.']', true)
                    ->setValue('['.$lcControl.'Options]', $renderer->render($controlManager->{'get'.$control}()), false);
            }
        }
    }
}
