<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_name' => fake()->text(128),
            'album_thumb' => fake()->text(128),
            'description' => fake()->text(128),
            'user_id' =>User::query()->inRandomOrder()->first()?->id ?? User::factory()->create()
        ];
    }
}
