<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;

final class PointEvent
{
    /**
     * @var integer
     */
    private $customerId;
    /**
     * @var string
     */
    private $event;
    /**
     * @var integer
     */
    private $point;
    /**
     * @var CarbonImmutable
     */
    private $createdAt;

    /**
     * constructor
     *
     * @param integer         $customerId
     * @param string          $event
     * @param integer         $point
     * @param CarbonImmutable $createdAt
     */
    public function __construct(
        int $customerId,
        string $event,
        int $point,
        CarbonImmutable $createdAt
    ) {
        $this->customerId = $customerId;
        $this->event = $event;
        $this->point = $point;
        $this->createdAt = $createdAt;
    }

    /**
     * @return integer
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @return integer
     */
    public function getPoint(): int
    {
        return $this->point;
    }

    /**
     * @return CarbonImmutable
     */
    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }
}
