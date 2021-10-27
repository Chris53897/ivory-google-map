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

class SourceRenderer extends AbstractRenderer
{
    public function render(string $name, ?string $source = null, ?string $variable = null, bool $newLine = true): string
    {
        $formatter = $this->getFormatter();
        $source = $source ?: 'src';
        $variable = $variable ?: 'script';

        return $formatter->renderClosure($formatter->renderLines([
            $formatter->renderAssignment(
                'var '.$variable,
                $formatter->renderCall(
                    $formatter->renderProperty('document', 'createElement'),
                    [$formatter->renderEscape('script')]
                ),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'type'),
                $formatter->renderEscape('text/javascript'),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'async'),
                $formatter->renderEscape(true),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'src'),
                $source,
                true
            ),
            $formatter->renderCall(
                $formatter->renderProperty(
                    $formatter->renderCall(
                        $formatter->renderProperty('document', 'getElementsByTagName'),
                        [$formatter->renderEscape('head')]
                    ).'[0]',
                    'appendChild'
                ),
                [$variable],
                true
            ),
        ], true, false), [$source], $name, true, $newLine);
    }
}
