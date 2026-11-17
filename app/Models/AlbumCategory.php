<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $album_id
 * @property int $album_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Album|null $album
 * @property-read \App\Models\AlbumCategories $category
 * @method static \Database\Factories\AlbumCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereAlbumCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlbumCategory extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumCategoryFactory> */
    use HasFactory;
    protected $table = 'album_category'; //questo model deve leggere e scrivere esclusivamente nella tabella category, ignora la convenzione con i nomi plurali per le pivot

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id'); //la singola entità album appartiene alla colonna album_id della pivot che punta a un elemento della classe Album
    } //in questo caso sarebbe anche possibile sottintendere album_id poichè rispetta la sintassi standard

    public function category()
    {
        return $this->belongsTo(AlbumCategories::class, 'album_category_id'); //idem
    }

}
