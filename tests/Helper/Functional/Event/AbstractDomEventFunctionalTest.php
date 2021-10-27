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

namespace Ivory\Tests\GoogleMap\Helper\Functional\Event;

use Ivory\GoogleMap\Map;

abstract class AbstractDomEventFunctionalTest extends AbstractEventFunctionalTest
{
    /** @var string */
    private $spyButton;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        parent::setUp();

        $this->spyButton = 'spy_button';
    }

    /** {@inheritdoc} */
    protected function renderMap(Map $map, $html = null)
    {
        return parent::renderMap($map, $html ?: '<button id="'.$this->spyButton.'">Button</button>');
    }

    /** {@inheritdoc} */
    protected function createEvent($instance = null)
    {
        return parent::createEvent($instance ?: 'document.getElementById("'.$this->spyButton.'")');
    }

    protected function clickSpyButton()
    {
        $this->byId($this->spyButton)->click();
    }
}
