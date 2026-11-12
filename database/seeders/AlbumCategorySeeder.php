<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creare per ogni album una categoria, per popolare la tabella pivot
        $albums = Album::pluck('id');
        foreach($albums as $album){
            foreach(range(0,3) as $val){ //creo per ogni album 3 categorie diverse
                try{
                    AlbumCategory::factory()->create([
                        'album_id' =>$album
                    ]);
                }
                catch(Exception $e){
                    echo $e->getMessage();
                }
            }
        }

        AlbumCategory::factory()->create(); //gli utenti li creiamo agganciandoli automaticamente all

    }
}
