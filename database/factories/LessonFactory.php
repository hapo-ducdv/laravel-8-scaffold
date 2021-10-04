<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'desc' => $this->faker->text(255),
            'time' => $this->faker->randomDigit(),
            'course_id' => $this->faker->numberBetween(1, 100),
            'teacher_id' => $this->faker->numberBetween(1, 15)
        ];
    }
}
