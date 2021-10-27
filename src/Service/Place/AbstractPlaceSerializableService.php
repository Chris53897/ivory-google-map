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

namespace Ivory\GoogleMap\Service\Place;

use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\Serializer\SerializerInterface;
use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Message\RequestFactoryInterface as MessageFactory;

abstract class AbstractPlaceSerializableService extends AbstractSerializableService
{
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null,
        string $context = null
    ) {
        if (null !== $context) {
            $context = '/'.$context;
        }

        parent::__construct(
            'https://maps.googleapis.com/maps/api/place'.$context,
            $client,
            $messageFactory,
            $serializer
        );
    }
}
