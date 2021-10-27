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

namespace Ivory\Tests\GoogleMap\Helper\Event;

use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\Event;

class EventTest extends TestCase
{
    /** @var AbstractEvent */
    private $event;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->event = $this->createAbstractEventMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(Event::class, $this->event);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->event->hasCode());
        $this->assertSame('', $this->event->getCode());
    }

    public function testSetCode()
    {
        $this->event->setCode($code = 'code');
        $this->event->setCode($code);

        $this->assertTrue($this->event->hasCode());
        $this->assertSame($code, $this->event->getCode());
    }

    public function testAddCode()
    {
        $this->event->setCode($firstCode = 'code1');
        $this->event->addCode($secondCode = 'code2');

        $this->assertTrue($this->event->hasCode());
        $this->assertSame($firstCode.$secondCode, $this->event->getCode());
    }

    /** @return MockObject|AbstractEvent */
    private function createAbstractEventMock()
    {
        return $this->getMockForAbstractClass(AbstractEvent::class);
    }
}
