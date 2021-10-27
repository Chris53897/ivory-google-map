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

namespace Ivory\GoogleMap\Service\Place\Photo;

use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequestInterface;

class PlacePhotoService extends AbstractService
{
    public function __construct()
    {
        parent::__construct('https://maps.googleapis.com/maps/api/place/photo');
    }

    public function process(PlacePhotoRequestInterface $request): string
    {
        return $this->createUrl($request);
    }
}
