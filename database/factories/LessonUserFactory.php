<?php

namespace Database\Factories;

use App\Models\LessonUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LessonUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' => $this->faker->numberBetween(1, 3300),
            'user_id' => $this->faker->numberBetween(1, 300)
        ];
    }
}
