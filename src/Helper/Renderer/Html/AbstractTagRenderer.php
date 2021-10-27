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

namespace Ivory\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

class AbstractTagRenderer extends AbstractRenderer
{
    /** @var TagRenderer */
    private $tagRenderer;

    public function __construct(Formatter $formatter, TagRenderer $tagRenderer)
    {
        parent::__construct($formatter);

        $this->setTagRenderer($tagRenderer);
    }

    public function getTagRenderer(): TagRenderer
    {
        return $this->tagRenderer;
    }

    public function setTagRenderer(TagRenderer $tagRenderer): void
    {
        $this->tagRenderer = $tagRenderer;
    }
}
