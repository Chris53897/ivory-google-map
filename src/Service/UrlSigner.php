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

namespace Ivory\GoogleMap\Service;

class UrlSigner
{
    public static function sign(string $url, string $secret, ?string $clientId = null, ?string $channel = null): string
    {
        if (null !== $clientId) {
            $url .= '&client=gme-'.$clientId;
        }

        if (null !== $channel) {
            $url .= '&channel='.$channel;
        }

        $urlParts  = parse_url($url);
        $data      = $urlParts['path'].'?'.$urlParts['query'];
        $key       = base64_decode(str_replace(['-', '_'], ['+', '/'], $secret));
        $signature = base64_encode(hash_hmac('sha1', $data, $key, true));

        return $url.'&signature='.str_replace(['+', '/'], ['-', '_'], $signature);
    }
}
