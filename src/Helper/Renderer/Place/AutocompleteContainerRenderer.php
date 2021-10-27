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

namespace Ivory\GoogleMap\Helper\Renderer\Place;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;

class AutocompleteContainerRenderer extends AbstractJsonRenderer
{
    public function render(): string
    {
        return $this->getJsonBuilder()
            ->setValue('[base][coordinates]', [])
            ->setValue('[base][bounds]', [])
            ->setValue('[autocomplete]', null)
            ->setValue('[events][dom_events]', [])
            ->setValue('[events][dom_events_once]', [])
            ->setValue('[events][events]', [])
            ->setValue('[events][events_once]', [])
            ->build();
    }
}
