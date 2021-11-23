<?php

namespace Tests\Unit;

use App\Services\CalculatePointService;
use App\Exceptions\PreconditionException;
use PHPUnit\Framework\TestCase;

class CalculatePointServiceTest extends TestCase
{
    public function dataProvider_for_calcPoint(): array
    {
        return [
            '購入金額が0なら0ポイント' => [0, 0],
            '購入金額が999なら0ポイント' => [0, 999],
            '購入金額が1000なら10ポイント' => [10, 1000],
            '購入金額が9999なら99ポイント' => [99, 9999],
            '購入金額が10000なら200ポイント' => [200, 10000]
        ];
    }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     */
    public function calcPoint(int $expected, int $amount)
    {
        $result = CalculatePointService::calcPoint($amount);

        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function calcPoint_購入金額が負の数なら例外をスロー()
    {
        $this->expectException(PreconditionException::class);
        $this->expectExceptionMessage('購入金額が負の数');

        CalculatePointService::calcPoint(-1);
    }
}
