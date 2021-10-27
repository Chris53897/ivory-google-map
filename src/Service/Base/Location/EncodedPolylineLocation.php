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

class EncodedPolylineLocation implements LocationInterface
{
    /** @var string */
    private $encodedPolyline;

    public function __construct(string $encodedPolyline)
    {
        $this->setEncodedPolyline($encodedPolyline);
    }

    public function getEncodedPolyline(): string
    {
        return $this->encodedPolyline;
    }

    public function setEncodedPolyline(string $encodedPolyline): void
    {
        $this->encodedPolyline = $encodedPolyline;
    }

    /** {@inheritdoc} */
    public function buildQuery(): string
    {
        return 'enc:'.$this->encodedPolyline;
    }
}
