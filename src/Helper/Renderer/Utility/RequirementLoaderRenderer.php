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

namespace Ivory\GoogleMap\Helper\Renderer\Utility;

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

class RequirementLoaderRenderer extends AbstractRenderer
{
    public function render(
        string $name,
        ?string $intervalVariable = null,
        ?string $callbackVariable = null,
        ?string $requirementVariable = null,
        int $interval = 10,
        bool $newLine = true
    ): string {
        $formatter = $this->getFormatter();

        $intervalVariable    = $intervalVariable ?: 'i';
        $callbackVariable    = $callbackVariable ?: 'c';
        $requirementVariable = $requirementVariable ?: 'r';

        return $formatter->renderClosure($this->renderRequirement(
            $intervalVariable,
            $callbackVariable,
            $requirementVariable,
            $formatter->renderStatement('else', $formatter->renderAssignment(
                'var '.$intervalVariable,
                $formatter->renderCall('setInterval', [
                    $formatter->renderClosure($this->renderRequirement(
                        $intervalVariable,
                        $callbackVariable,
                        $requirementVariable
                    )),
                    $interval,
                ], true)
            ), null, null, false)
        ), [$callbackVariable, $requirementVariable], $name, true, $newLine);
    }

    private function renderRequirement(
        string $intervalVariable,
        string $callbackVariable,
        string $requirementVariable,
        ?string $nextStatement = null
    ): string {
        $formatter = $this->getFormatter();
        $codes     = [$formatter->renderCall($callbackVariable, [], true)];

        if (empty($nextStatement)) {
            array_unshift($codes, $formatter->renderCall('clearInterval', [$intervalVariable], true));
        }

        return $formatter->renderStatement(
            'if',
            $formatter->renderLines($codes, true, false),
            $formatter->renderCall($requirementVariable),
            $nextStatement,
            false
        );
    }
}
