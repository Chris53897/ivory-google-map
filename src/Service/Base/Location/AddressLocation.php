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

namespace Ivory\GoogleMap\Service\Base\Location;

class AddressLocation implements LocationInterface
{
    /** @var string */
    private $address;

    public function __construct(string $address)
    {
        $this->setAddress($address);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /** {@inheritdoc} */
    public function buildQuery(): string
    {
        return $this->address;
    }
}
