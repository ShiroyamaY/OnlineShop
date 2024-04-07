<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->word(2,true)),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomDigit(),
            'thumbnail' => $this->faker->imageUrl(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
