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

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference#Symbol
 */
class Symbol implements OptionsAwareInterface, VariableAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /** @var string */
    private $path;

    /** @var Point|null */
    private $anchor;

    /** @var Point|null */
    private $labelOrigin;

    public function __construct(string $path, Point $anchor = null, Point $labelOrigin = null, array $options = [])
    {
        $this->setPath($path);
        $this->setAnchor($anchor);
        $this->setLabelOrigin($labelOrigin);
        $this->setOptions($options);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function hasAnchor(): bool
    {
        return null !== $this->anchor;
    }

    public function getAnchor(): ?Point
    {
        return $this->anchor;
    }

    public function setAnchor(Point $anchor = null): void
    {
        $this->anchor = $anchor;
    }

    public function hasLabelOrigin(): bool
    {
        return null !== $this->labelOrigin;
    }

    public function getLabelOrigin(): ?Point
    {
        return $this->labelOrigin;
    }

    public function setLabelOrigin(Point $labelOrigin = null): void
    {
        $this->labelOrigin = $labelOrigin;
    }
}
