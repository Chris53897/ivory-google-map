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

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;

class LoaderRenderer extends AbstractJsonRenderer
{
    /** @var string */
    private $language;

    /** @var string|null */
    private $key;

    public function __construct(Formatter $formatter, JsonBuilder $jsonBuilder, string $language = 'en', ?string $key = null)
    {
        parent::__construct($formatter, $jsonBuilder);

        $this->setLanguage($language);
        $this->setKey($key);
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function hasKey(): bool
    {
        return null !== $this->key;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    /** @param string[] $libraries */
    public function render(
        string $name,
        string $callback,
        array $libraries = [],
        bool $newLine = true
    ): string {
        $formatter   = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $parameters = ['language' => $this->language];

        if ($this->hasKey()) {
            $parameters['key'] = $this->key;
        }

        if (!empty($libraries)) {
            $parameters['libraries'] = implode(',', $libraries);
        }

        $jsonBuilder
            ->setValue('[other_params]', urldecode(http_build_query($parameters, '', '&')))
            ->setValue('[callback]', $callback, false);

        return $formatter->renderClosure($formatter->renderCall($formatter->renderProperty('google', 'load'), [
            $formatter->renderEscape('maps'),
            $formatter->renderEscape('3'),
            $jsonBuilder->build(),
        ]), [], $name, true, $newLine);
    }

    public function renderSource(string $callback, ?array $libraries = []): string
    {
        if ($this->hasKey()) {
            $arguments['key'] = $this->key;
        }

        if ($libraries) {
            $arguments['libraries'] = implode(',', $libraries);
        }

        $arguments['callback'] = $callback;

        return 'https://maps.googleapis.com/maps/api/js?'.http_build_query($arguments);
    }
}
