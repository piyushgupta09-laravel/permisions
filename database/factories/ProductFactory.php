<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'short' => $this->faker->sentence,
            'detail' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'unit' => $this->faker->randomElement($array = array ('unit','piece','pack')),
            'image' => $this->faker->image('public/storage/products',640,480, null, false)
        ];
    }
}
