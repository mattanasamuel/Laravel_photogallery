<?php

namespace Database\Seeders;

use App\Models\AlbumCategory;
use App\Models\User;
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
        AlbumCategory::factory()->create();
    }
}
