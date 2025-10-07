<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'computer_brand' => $this->faker->company(),
            'computer_model' => $this->faker->word(),
            'computer_price' => $this->faker->randomFloat(2, 300, 3000),
            'computer_ram_size' => $this->faker->randomElement([4, 8, 16, 32, 64]),
            'computer_is_laptop' => $this->faker->boolean(),
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id_category,
            'computer_barcode' => $this->faker->unique()->numerify('##########'),
        ];
    }
}
