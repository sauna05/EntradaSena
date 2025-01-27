<?php

namespace Database\Factories\DbEntrada;

use App\Models\DbEntrada\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DbEntrada\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_role' => Role::factory(),
            'document_number' => Fake()->numerify('##########'),
            'name' => fake()->name(1),
            'start_date'=>fake()->date(),
            'end_date'=>fake()->date()
        ];
    }
}
