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

namespace Ivory\GoogleMap\Helper\Renderer\Layer;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Map;

class KmlLayerRenderer extends AbstractJsonRenderer
{
    public function render(KmlLayer $kmlLayer, Map $map): string
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($kmlLayer->getOptions());

        return $formatter->renderObjectAssignment($kmlLayer, $formatter->renderObject('KmlLayer', [
            $formatter->renderEscape($kmlLayer->getUrl()),
            $jsonBuilder->build(),
        ]));
    }
}
