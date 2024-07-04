<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "image" => $this->faker->imageUrl(),
            "description" => $this->faker->paragraph(),
            "stock" => $this->faker->numberBetween(1, 100),
            "harga" => $this->faker->numberBetween(1000, 100000),
            "berat" => $this->faker->randomFloat(2, 0.1, 10),
        ];
    }
}
