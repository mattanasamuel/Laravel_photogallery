<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\AlbumCategories;
use App\Models\AlbumCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AlbumCategory>
 */
class AlbumCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'album_id' => Album::factory(),
            'album_category_id' => AlbumCategories::factory()
        ];
    }
}
