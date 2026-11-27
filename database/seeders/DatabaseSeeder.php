<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategories;
use App\Models\AlbumCategory;
use App\Models\Photo;
use App\Models\User;
use Database\Factories\AlbumCategoriesFactory;
use Database\Factories\AlbumCategoryFactory;
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
        User::factory()
            ->count(5)
            //un utente ha un album che a sua volta ha foto, perciò chiamo la sua factory e a sua volta chiama il metodo magico
            ->has( //sarebbe hasalbum, ma ha un figlio
                Album::factory(2)->hasPhotos(50)
            )
            ->afterCreating(function(User $user) { //ovviamente riferito all'utente
                $randomNames = collect(AlbumCategoriesFactory::$categories)->shuffle()->take(5);

                $createdCategories = $randomNames->map(function ($name) use ($user){
                    return AlbumCategories::factory()->create([
                        'user_id' => $user->id,
                        'category_name' => $name,
                    ]);
                });

                foreach($user->albums as $album){
                    $twoCategories = $createdCategories->random(2);
                    foreach($twoCategories as $category){
                        $category->albums()->attach($album->id); //inserisco relazione nella pivot
                    }
                }

            })->create();
    }
}
