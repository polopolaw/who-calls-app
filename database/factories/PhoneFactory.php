<?php

namespace Database\Factories;

use App\Models\Phone;
use Brick\PhoneNumber\PhoneNumberType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Phone>
 */
class PhoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'phone' => fake()->e164PhoneNumber,
            'type' => fake()->randomElement([PhoneNumberType::MOBILE, PhoneNumberType::VOIP]),
            'region_code' => fake()->numberBetween(100, 400),
            'country_code' => fake()->numberBetween(100, 400),
            'national_number' => fake()->numberBetween(100, 400),
            'last_sync' => fake()->dateTime
        ];
    }
}
