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

namespace Ivory\Tests\GoogleMap\Helper\Functional\Place\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\Tests\GoogleMap\Helper\Functional\Place\AbstractAutocompleteFunctionalTest;
use PHPUnit\Extensions\Selenium2TestCase\Keys;

abstract class AbstractEventFunctionalTest extends AbstractAutocompleteFunctionalTest
{
    /** @var string */
    private $spyCount;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        parent::setUp();

        $this->spyCount = 'spy_count';
    }

    protected function selectAutocomplete(): void
    {
        sleep(1);

        $this->keys(Keys::DOWN);
        $this->keys(Keys::ENTER);

        sleep(1);
    }

    /** @param int $count */
    protected function assertSpyCount($count): void
    {
        $this->assertSameVariable($count, $this->spyCount);
    }

    /** @param string $instance */
    protected function createEvent($instance): Event
    {
        return new Event(
            $instance,
            'place_changed',
            <<<EOF
function () { 
    if (typeof {$this->spyCount} === typeof undefined) { 
        {$this->spyCount} = 1; 
    } else { 
        {$this->spyCount}++; 
    }
}
EOF
        );
    }
}
