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
    public static array $categories = ['landscape', 'mountains', 'cats', 'dogs', 'nightlife', 'cars', 'whatsapp', 'screenshots', 'birds'];
    public function definition(): array
    {
        return [
            'category_name' => collect($this::$categories)->shuffle()->take(1),
            'description' => fake()->text(),
            'user_id' => User::factory()
        ];
    }
}
