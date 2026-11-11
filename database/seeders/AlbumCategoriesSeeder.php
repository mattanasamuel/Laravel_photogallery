<?php

namespace Database\Seeders;

use App\Models\AlbumCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlbumCategories::factory()->create();
    }
}
