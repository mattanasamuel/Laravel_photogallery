<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategories;
use App\Models\AlbumCategory;
use App\Models\Photo;
use App\Models\User;
use Database\Factories\PhotoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        //non ci serve creare l'utente perchè viene creato nel seeder dell'album category
        User::factory(15)->create(); //creo 15 utenti
        Album::factory()->create();
        AlbumCategories::factory()->create();
        AlbumCategory::factory()->create();
        Photo::factory(100)->create();
    }
}
