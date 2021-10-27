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

namespace Ivory\Tests\GoogleMap\Service;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleRetry\GuzzleRetryMiddleware;
use Ivory\Tests\GoogleMap\Service\Utility\History;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class AbstractFunctionalServiceTest extends TestCase
{
    protected $journal;

    /** @var ClientInterface */
    protected $client;

    /** @var RequestFactoryInterface */
    protected $messageFactory;

    /** @var CacheItemPoolInterface */
    protected $pool;

    /** {@inheritdoc} */
    protected function setUp(): void
    {
        if (isset($_SERVER['CACHE_RESET']) && $_SERVER['CACHE_RESET']) {
            sleep(2);
        }

        $this->pool = new FilesystemAdapter('', 0, $_SERVER['CACHE_PATH']);
        $this->messageFactory = new HttpFactory();

        $handlerStack = HandlerStack::create();

        $this->journal = new History();
        $history = Middleware::history($this->journal);
        $handlerStack->push($history);

        $retry = GuzzleRetryMiddleware::factory([
            'max_retry_attempts' => 5,
        ]);
        $handlerStack->push($retry);

        $this->client = new Client(['handler' => $handlerStack]);
    }

    protected function getDateTime(string $key, $value = 'now'): DateTime
    {
        $item = $this->pool->getItem(sha1(__CLASS__.'::'.$key));

        if (!$item->isHit()) {
            $item->set(new DateTime($value));
            $this->pool->save($item);
        }

        return $item->get();
    }
}
