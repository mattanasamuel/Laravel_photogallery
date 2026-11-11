<?php

namespace Database\Factories;

use App\Models\AlbumCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AlbumCategories>
 */
class AlbumCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static array $categories = ['landscape', 'mountains', 'cats', 'dogs'];
    public function definition(): array
    {
        return [
            'category_name' => fake()->randomElement(static::$categories),
            'description' => fake()->text(),
            'user_id' => User::query()->inRandomOrder()->first()?->id ?? User::factory()->create()
        ];
    }
}
