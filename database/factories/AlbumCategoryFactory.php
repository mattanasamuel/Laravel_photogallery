<?php

namespace Database\Factories;

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
    protected static array $categories = ['landscape', 'mountains', 'cats', 'dogs'];
    public function definition(): array
    {
        return [
            'category_name' => fake()->randomElement(static::$categories), //prendo un valore pseudo casuale
            'description' => fake()->text(),
            'user_id' => User::factory() //creo l'utente al momento, così si associa all'album
        ];
    }
}
