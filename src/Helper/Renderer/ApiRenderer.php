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
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementLoaderRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\SourceRenderer;
use SplObjectStorage;

class ApiRenderer extends AbstractRenderer
{
    /** @var ApiInitRenderer */
    private $apiInitRenderer;

    /** @var LoaderRenderer */
    private $loaderRenderer;

    /** @var RequirementLoaderRenderer */
    private $requirementLoaderRenderer;

    /** @var SourceRenderer */
    private $sourceRenderer;

    public function __construct(
        Formatter $formatter,
        ApiInitRenderer $apiInitRenderer,
        LoaderRenderer $loaderRenderer,
        RequirementLoaderRenderer $requirementLoaderRenderer,
        SourceRenderer $sourceRenderer
    ) {
        parent::__construct($formatter);

        $this->setApiInitRenderer($apiInitRenderer);
        $this->setLoaderRenderer($loaderRenderer);
        $this->setRequirementLoaderRenderer($requirementLoaderRenderer);
        $this->setSourceRenderer($sourceRenderer);
    }

    public function getApiInitRenderer(): ApiInitRenderer
    {
        return $this->apiInitRenderer;
    }

    public function setApiInitRenderer(ApiInitRenderer $apiInitRenderer): void
    {
        $this->apiInitRenderer = $apiInitRenderer;
    }

    public function getLoaderRenderer(): LoaderRenderer
    {
        return $this->loaderRenderer;
    }

    public function setLoaderRenderer(LoaderRenderer $loaderRenderer): void
    {
        $this->loaderRenderer = $loaderRenderer;
    }

    public function getRequirementLoaderRenderer(): RequirementLoaderRenderer
    {
        return $this->requirementLoaderRenderer;
    }

    public function setRequirementLoaderRenderer(RequirementLoaderRenderer $requirementLoaderRenderer): void
    {
        $this->requirementLoaderRenderer = $requirementLoaderRenderer;
    }

    public function getSourceRenderer(): SourceRenderer
    {
        return $this->sourceRenderer;
    }

    public function setSourceRenderer(SourceRenderer $sourceRenderer): void
    {
        $this->sourceRenderer = $sourceRenderer;
    }

    /**
     * @param string[] $sources
     * @param string[] $libraries
     */
    public function render(
        SplObjectStorage $callbacks,
        SplObjectStorage $requirements,
        array $sources = [],
        array $libraries = []
    ): string
    {
        $formatter = $this->getFormatter();

        $loadCallback = $this->getCallbackName('load');
        $initCallback = $this->getCallbackName('init');
        $initSourceCallback = $this->getCallbackName('init_source');
        $initRequirementCallback = $this->getCallbackName('init_requirement');

        return $formatter->renderLines([
            $this->loaderRenderer->render($loadCallback, $initCallback, $libraries, false),
            $this->sourceRenderer->render($initSourceCallback, null, null, false),
            $this->requirementLoaderRenderer->render($initRequirementCallback, null, null, null, 100, false),
            $this->apiInitRenderer->render(
                $initCallback,
                $callbacks,
                $requirements,
                $sources,
                $initSourceCallback,
                $initRequirementCallback,
                false
            ),
            $formatter->renderCall($initSourceCallback, [
                $formatter->renderEscape($this->loaderRenderer->renderSource($initCallback, $libraries)),
            ], true),
        ], true, false);
    }

    private function getCallbackName(string $callback): string
    {
        return 'ivory_google_map_'.$callback;
    }
}
