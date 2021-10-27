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

namespace Ivory\GoogleMap\Layer;

use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

class KmlLayer implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /** @var string */
    private $url;

    public function __construct(string $url, array $options = [])
    {
        $this->setUrl($url);
        $this->addOptions($options);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }
}
