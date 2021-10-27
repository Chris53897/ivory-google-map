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

namespace Ivory\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;

abstract class AbstractJavascriptHelperBuilder extends AbstractHelperBuilder
{
    /** @var Formatter */
    private $formatter;

    /** @var JsonBuilder */
    private $jsonBuilder;

    public function __construct(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        $this->formatter = $formatter ?: new Formatter();
        $this->jsonBuilder = $jsonBuilder ?: new JsonBuilder();
    }

    public function getFormatter(): Formatter
    {
        return $this->formatter;
    }

    public function setFormatter(Formatter $formatter): AbstractJavascriptHelperBuilder
    {
        $this->formatter = $formatter;

        return $this;
    }

    public function getJsonBuilder(): JsonBuilder
    {
        return $this->jsonBuilder;
    }

    public function setJsonBuilder(JsonBuilder $jsonBuilder): AbstractJavascriptHelperBuilder
    {
        $this->jsonBuilder = $jsonBuilder;

        return $this;
    }
}
