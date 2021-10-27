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

namespace Ivory\GoogleMap\Service\Serializer;

use Ivory\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Ivory\Serializer\Mapping\Factory\ClassMetadataFactory;
use Ivory\Serializer\Mapping\Loader\DirectoryClassMetadataLoader;
use Ivory\Serializer\Navigator\Navigator;
use Ivory\Serializer\Registry\TypeRegistry;
use Ivory\Serializer\Serializer;
use Ivory\Serializer\Type\ObjectType;
use Ivory\Serializer\Type\Type;
use Psr\Cache\CacheItemPoolInterface;

class SerializerBuilder
{
    /** @return Serializer */
    public static function create(CacheItemPoolInterface $pool = null)
    {
        $classMetadataFactory = new ClassMetadataFactory(new DirectoryClassMetadataLoader(__DIR__));

        if (null !== $pool) {
            $classMetadataFactory = new CacheClassMetadataFactory($classMetadataFactory, $pool);
        }

        return new Serializer(new Navigator(TypeRegistry::create([
            Type::OBJECT => new ObjectType($classMetadataFactory),
        ])));
    }
}
