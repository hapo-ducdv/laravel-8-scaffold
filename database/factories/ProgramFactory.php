<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' => $this->faker->numberBetween(1, 3300),
            'name' => $this->faker->name(),
            'type' => $this->faker->numberBetween(1, 3),
            'path' => $this->faker->imageUrl(900, 500),
        ];
    }
}
