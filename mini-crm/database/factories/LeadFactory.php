<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name'   => $this->faker->name(),
            'phone'       => $this->faker->numerify('##########'),
            'status'      => $this->faker->randomElement(['new', 'in_progress', 'done']),
            'note'        => $this->faker->optional()->sentence(),
            // assigned_to задаём в сидере
        ];
    }
}
