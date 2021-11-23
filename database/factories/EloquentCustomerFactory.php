<?php

namespace Database\Factories;

use App\Models\EloquentCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentCustomerFactory extends Factory
{
    protected $model = EloquentCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}
