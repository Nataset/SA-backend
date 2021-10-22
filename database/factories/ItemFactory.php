<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Product ###'),
            'amount' => $this->faker->numberBetween($min = 5, $max = 100),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
            'image_path' => NULL,
            'min_item' => $this->faker->numberBetween($min = 2, $max = 10),
        ];
    }
}
