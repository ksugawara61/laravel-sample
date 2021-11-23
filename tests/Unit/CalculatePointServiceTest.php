<?php

namespace Tests\Unit;

use App\Services\CalculatePointService;
use PHPUnit\Framework\TestCase;

class CalculatePointServiceTest extends TestCase
{
    /**
     * @test
     */
    public function calcPoint_購入金額が0ならポイントは0()
    {
        $result = CalculatePointService::calcPoint(0);

        $this->assertSame(0, $result);
    }

    /**
     * @test
     */
    public function calcPoint_購入金額が1000ならポイントは10()
    {
        $result = CalculatePointService::calcPoint(1000);

        $this->assertSame(10, $result);
    }
}
