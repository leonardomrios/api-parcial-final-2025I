<?php

namespace Database\Factories;

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
            'category_name' => $this->faker->unique()->words(2, true),
            'category_description' => $this->faker->paragraph(3),
            'category_order' => $this->faker->numberBetween(1, 100),
            'category_discount' => $this->faker->optional(0.7)->randomFloat(2, 0, 50),
            'estado' => $this->faker->boolean(80), // 80% de probabilidad de estar activo
        ];
    }
}
