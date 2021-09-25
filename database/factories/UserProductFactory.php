<?php

namespace Database\Factories;

use App\Models\UserProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>rand(1, 10),
            'product_name' => $this->faker->name(),
            'qty_user_requested' => rand(1, 20),
            'price' => rand(1, 100),
        ];
    }
}
