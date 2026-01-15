<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::inRandomOrder()->first()->id,
            'title'   => $this->faker->sentence(3),
            'due_at'  => $this->faker->optional()->dateTimeBetween('now', '+7 days'),
            'is_done' => $this->faker->boolean(30),
        ];
    }
}
