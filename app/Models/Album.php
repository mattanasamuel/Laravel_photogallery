<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;
    public function categories (): BelongsToMany
    {
        return $this->belongsToMany(AlbumCategory::class, 'album_category', 'album_id', 'album_category_id'); //le relazione many to many devono essere dichiarate manualmente?
    }
}
