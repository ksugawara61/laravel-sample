<?php

namespace Tests\Feature\Api;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddPointTest extends TestCase
{
    use RefreshDatabase;

    private const CUSTOMER_ID = 1;

    protected function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow();

        EloquentCustomer::factory()->create(
            [
                'id' => self::CUSTOMER_ID
            ]
        );
        EloquentCustomerPoint::unguard();
        EloquentCustomerPoint::create(
            [
                'customer_id' => self::CUSTOMER_ID,
                'point' => 100
            ]
        );
            EloquentCustomerPoint::reguard();
    }

    /**
     * @test
     */
    public function putAddPoint()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
                'customer_id' => self::CUSTOMER_ID,
                'add_point' => 10
            ]
        );

        $response->assertStatus(200);
        $expected = ['customer_point' => 110];
        $response->assertExactJson($expected);

        $this->assertDatabaseHas(
            'customer_points',
            [
                'customer_id' => self::CUSTOMER_ID,
                'point' => 110
            ]
        );

        $this->assertDatabaseHas(
            'customer_point_events',
            [
                'customer_id' => self::CUSTOMER_ID,
                'event' => 'ADD_POINT',
                'point' => 10,
                'created_at' => CarbonImmutable::now()->toDateTimeString()
            ]
        );
    }

    /**
     * @test
     */
    public function putAddPointValidationError()
    {
        $response = $this->putJson('/api/customers/add_point', []);

        $response->assertStatus(422);
        $expected = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'customer_id' => [
                    'The customer id field is required.'
                ],
                'add_point' => [
                    'The add point field is required.'
                ]
            ]
        ];
        $response->assertJson($expected);
    }

    /**
     * @test
     */
    public function putAddPointValidationErrorOnlyErrors()
    {
        $response = $this->putJson('/api/customers/add_point', []);

        $response->assertStatus(422);
        $expected = [
            'errors' => [
                'customer_id' => [
                    'The customer id field is required.'
                ],
                'add_point' => [
                    'The add point field is required.'
                ]
            ]
        ];
        $response->assertJson($expected);
    }

    /**
     * @test
     */
    public function putAddPointValidationErrorOnlyKey()
    {
        $response = $this->putJson('/api/customers/add_point', []);

        $response->assertStatus(422);

        $jsonValues = $response->json();
        $this->assertArrayHasKey('errors', $jsonValues);

        $errors = $jsonValues['errors'];
        $this->assertArrayHasKey('customer_id', $errors);
        $this->assertArrayHasKey('add_point', $errors);
    }

    public function dataProviderPutAddPointForAddPoint(): array
    {
        return [
            [0],
            [-1]
        ];
    }

    /**
     * @test
     * @dataProvider dataProviderPutAddPointForAddPoint
     */
    public function putAddPointValidationErrorForAddPoint(int $addPoint)
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => self::CUSTOMER_ID,
            'add_point' => $addPoint
        ]);

        $response->assertStatus(400);
        $expected = [
            'message' => 'add_point should be equals or greater than 1',
        ];
        $response->assertJson($expected);
    }

    /**
     * @test
     */
    public function putAddPointValidationErrorForCustomerId()
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => 999,
            'add_point' => 10
        ]);

        $response->assertStatus(400);
        $expected = [
            'message' => 'customers.customer_id:999 does not exists',
        ];
        $response->assertJson($expected);
    }
}
