<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Attachment;
use App\Models\User;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'path' => fake()->regexify('[A-Za-z0-9]{255}'),
            'size' => fake()->randomNumber(),
            'user_id' => User::factory(),
            'attachable_id' => fake()->randomNumber(),
            'attachable_type' => fake()->regexify('[A-Za-z0-9]{255}'),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
