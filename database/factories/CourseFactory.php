<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'desc' => $this->faker->text(190),
            'price' => $this->faker->numberBetween(300000, 3000000),
            'time' => $this->faker->numberBetween(50, 300),
            'teacher_id' => $this->faker->numberBetween(1, 15),
            'image' => '/assets/images/wibu.jpg',
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
