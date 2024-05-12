<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Phone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Visit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)
            ->create();

        Phone::factory(20)
            ->has(Comment::factory(rand(0, 1000)))
            ->create();

        Visit::factory(10000)
            ->create();
    }
}
