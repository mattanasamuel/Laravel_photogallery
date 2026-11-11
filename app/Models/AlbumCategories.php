<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlbumCategories extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumCategoriesFactory> */
    use HasFactory;
    public function albums (): BelongsToMany
    {
        return $this->belongsToMany(AlbumCategory::class, 'album_category', 'album_category_id', 'album_id'); //la related pivot key indica la foreign key dell'altra tabella al di là della pivot
    }
}
