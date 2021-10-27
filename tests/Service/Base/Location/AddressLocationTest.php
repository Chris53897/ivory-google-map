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

namespace Ivory\Tests\GoogleMap\Service\Base\Location;

use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use PHPUnit\Framework\TestCase;

class AddressLocationTest extends TestCase
{
    /** @var AddressLocation */
    private $addressLocation;

    /** @var string */
    private $address;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        $this->addressLocation = new AddressLocation($this->address = 'address');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(LocationInterface::class, $this->addressLocation);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->address, $this->addressLocation->getAddress());
    }

    public function testAddress()
    {
        $this->addressLocation->setAddress($address = 'foo');

        $this->assertSame($address, $this->addressLocation->getAddress());
    }

    public function testBuildQuery()
    {
        $this->assertSame($this->address, $this->addressLocation->buildQuery());
    }
}
