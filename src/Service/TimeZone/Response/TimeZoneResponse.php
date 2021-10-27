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

namespace Ivory\GoogleMap\Service\TimeZone\Response;

use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;

class TimeZoneResponse
{
    /** @var string|null */
    private $status;

    /** @var TimeZoneRequestInterface|null */
    private $request;

    /** @var int|null */
    private $dstOffset;

    /** @var int|null */
    private $rawOffset;

    /** @var string|null */
    private $timeZoneId;

    /** @var string|null */
    private $timeZoneName;

    public function hasStatus(): bool
    {
        return null !== $this->status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return null !== $this->request;
    }

    public function getRequest(): ?TimeZoneRequestInterface
    {
        return $this->request;
    }

    public function setRequest(TimeZoneRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasDstOffset(): bool
    {
        return null !== $this->dstOffset;
    }

    public function getDstOffset(): ?int
    {
        return $this->dstOffset;
    }

    public function setDstOffset(?int $dstOffset): void
    {
        $this->dstOffset = $dstOffset;
    }

    public function hasRawOffset(): bool
    {
        return null !== $this->rawOffset;
    }

    public function getRawOffset(): ?int
    {
        return $this->rawOffset;
    }

    public function setRawOffset(?int $rawOffset): void
    {
        $this->rawOffset = $rawOffset;
    }

    public function hasTimeZoneId(): bool
    {
        return null !== $this->timeZoneId;
    }

    public function getTimeZoneId(): ?string
    {
        return $this->timeZoneId;
    }

    public function setTimeZoneId(?string $timeZoneId): void
    {
        $this->timeZoneId = $timeZoneId;
    }

    public function hasTimeZoneName(): bool
    {
        return null !== $this->timeZoneName;
    }

    public function getTimeZoneName(): ?string
    {
        return $this->timeZoneName;
    }

    public function setTimeZoneName(?string $timeZoneName): void
    {
        $this->timeZoneName = $timeZoneName;
    }
}
