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

class ObjectToArrayRenderer extends AbstractRenderer
{
    public function render(?string $arrayVariable = null, ?string $objectVariable = null, ?string $keyVariable = null): string
    {
        $formatter = $this->getFormatter();

        $arrayVariable  = $arrayVariable ?: 'a';
        $objectVariable = $objectVariable ?: 'o';
        $keyVariable    = $keyVariable ?: 'k';

        return $formatter->renderClosure($formatter->renderLines([
            $formatter->renderAssignment('var '.$arrayVariable, '[]', true),
            $formatter->renderStatement(
                'for',
                $formatter->renderCall(
                    $formatter->renderProperty($arrayVariable, 'push'),
                    [$objectVariable.'['.$keyVariable.']'],
                    true
                ),
                'var '.$keyVariable.' in '.$objectVariable,
                null,
                false
            ),
            $formatter->renderCode('return '.$arrayVariable, true, false),
        ], true, false), [$objectVariable]);
    }
}
