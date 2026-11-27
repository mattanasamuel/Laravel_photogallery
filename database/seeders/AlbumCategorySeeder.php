<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumCategorySeeder extends Seeder //tabella pivot
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        AlbumCategory::factory()->create(); //gli utenti li creiamo agganciandoli automaticamente all

    }
}
