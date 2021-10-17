<?php

namespace Database\Factories;

use App\Models\ProgramUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProgramUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'program_id' => $this->faker->numberBetween(1, 10000),
            'user_id' => $this->faker->numberBetween(1, 300)
        ];
    }
}
