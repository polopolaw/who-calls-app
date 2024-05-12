<?php

namespace Database\Factories;

use App\Enums\FeedbackType;
use App\Models\Comment;
use App\Models\Phone;
use App\Models\User;
use GenderDetector\GenderDetector;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_id' => Phone::query()->inRandomOrder()->value('id'),
            'user_id' => fake()->randomElement(
                [User::query()->inRandomOrder()->value('id'), null]
            ),
            'name' => fake()->name,
            'content' => fake()->text(500),
            'avatar' => randomAvatar(fake()->randomElement(['male', 'female', 'unisex'])),
            'gender' => fake()->randomElement(['male', 'female', 'unisex']),
            'vote' => fake()->numberBetween(-10, 10),
            'feedback_type' => fake()->randomElement(FeedbackType::cases()),
            'emoji' => fake()->emoji(),
            'approved' => fake()->boolean()
        ];
    }
}
