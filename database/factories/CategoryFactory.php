<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Electronik',
                'Fashion', 
                'Makanan & Minuman', 
                'Kesehatan & Kecantikan', 
                'Otomotif',
                'Perabotan',
                'Olahraga',
            ]),
            'product_id' => product::all()->random()->id,
        ];
    }
}
