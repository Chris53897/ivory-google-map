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

use SplObjectStorage;

class ApiInitRenderer extends AbstractRenderer
{
    /** @param string[] $sources */
    public function render(
        string $name,
        SplObjectStorage $callbacks,
        SplObjectStorage $requirements,
        array $sources,
        string $sourceCallback,
        string $requirementCallback,
        bool $newLine = true
    ): string {
        $formatter = $this->getFormatter();
        $separator = $formatter->renderSeparator();
        $codes     = [];

        foreach ($sources as $source) {
            $codes[] = $formatter->renderCall($sourceCallback, [$formatter->renderEscape($source)], true);
        }

        foreach ($callbacks as $object) {
            $codes[] = $formatter->renderCall($requirementCallback, [
                $callbacks[$object],
                $formatter->renderClosure($formatter->renderCode(
                    'return '.implode(
                        $separator.'&&'.$separator,
                        isset($requirements[$object]) ? $requirements[$object] : []
                    ),
                    true,
                    false
                )),
            ], true);
        }

        return $formatter->renderClosure($formatter->renderLines($codes, true, false), [], $name, true, $newLine);
    }
}
