<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\User;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'action' => fake()->regexify('[A-Za-z0-9]{255}'),
            'details' => '{}',
            'loggable_id' => fake()->randomNumber(),
            'loggable_type' => fake()->regexify('[A-Za-z0-9]{255}'),
            'created_at' => fake()->dateTime(),
        ];
    }
}
